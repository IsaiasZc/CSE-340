<?php

//? Vehicles Controller

// Create or access a Session
session_start();

// Get connection database file
require_once '../library/connections.php';
// Get the PHP Motors modewl for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';
// Require the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

$navList = buildNavList($classifications);


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {

  case 'vehicle-man':

    include '../view/vehicle-man.php';
    exit;
    break;

  case 'addClassification':
    include '../view/add-classification.php';
    break;
  case 'addVehicles':
    // Call the buildClassificationList() function and store the resulting string
    $classificationList = buildClassificationList($classifications);
    include '../view/add-vehicles.php';
    break;

  case 'classification':
    // Filter and store the data
    $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    // validate with funtion checkClassificationName
    $checkClassificationName = checkClassificationName($classificationName);

    // Check for missing data
    if (empty($classificationName)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/add-classification.php';
      exit;
    }

    // Send the data to the model
    $regOutcome = regClassification($classificationName);

    // Check and report the result
    if ($regOutcome === 1) {

      // Rebuild the classifications array
      $classifications = getClassifications();

      // Rebuild the navigation list
      buildNavList($classifications);

      $message = "<p>Thanks for registering $classificationName.</p>";
      include '../view/vehicle-man.php';
      exit;
    }


    break;
  case 'vehicles':

    // Filter and store the data
    $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
    $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    // Call the buildClassificationList() function and store the resulting string
    $classificationList = buildClassificationList($classifications, $classificationId);

    // Check for missing data
    if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/add-vehicles.php';
      exit;
    }

    // Send the data to the model
    $regOutcome = regVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

    // Check and report the result
    if ($regOutcome === 1) {
      $message = "<p>The $invMake $invModel was added successfully!.</p>";
      include '../view/add-vehicles.php';
      exit;
    } else {
      $message = "<p>Sorry $invMake, but the registration failed. Please try again.</p>";
      include '../view/add-vehicles.php';
      exit;
    }

    // include '../view/vehicle-man.php';
    // exit;
    break;

  /* * ********************************** 
  * Get vehicles by classificationId 
  * Used for starting Update & Delete process 
  * ********************************** */ 

  case 'getInventoryItems':
    // Get the classificationId 
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    // Fetch the vehicles by classificationId from the DB 
    $inventoryArray = getInventoryByClassification($classificationId);
    // Convert the array to a JSON object and send it back 
    echo json_encode($inventoryArray);
    break;

  default:
    // functions to build classification list
    $classificationList = buildClassificationList($classifications);
    
    include '../view/vehicle-man.php';
    break;
}
