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

  case 'addClassificationView':
    include '../view/add-classification.php';
    break;
  case 'addVehicles':
    // Call the buildClassificationList() function and store the resulting string
    $classificationList = buildClassificationList($classifications);
    include '../view/add-vehicles.php';
    break;

  case 'addClassification':
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
    $classificationList = buildClassificationList($classifications);

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

  case 'mod':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if (count($invInfo) < 1) {
      $message = 'Sorry, no vehicles information could be found';
    };
    include '../view/vehicle-update.php';
    break;

  case 'updateVehicle':
    $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // variable to store the id
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
      $message = '<p>Please complete all information for the item! Double check the classification of the item.</p>';
      include '../view/vehicle-update.php';
      exit;
    }
    $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
    if ($updateResult) {
      $message = "<p>Congratulations, the $invMake $invModel was successfully updated.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');

      exit;
    } else {
      $message = "<p>Error. The new vehicle was not updated.</p>";
      include '../view/vehicle-update.php';
      exit;
    }
    break;

  case 'del':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if (count($invInfo) < 1) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-delete.php';
    exit;
    break;

  case 'deleteVehicle':
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    $deleteResult = deleteVehicle($invId);
    if ($deleteResult) {
      $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    } else {
      $message = "<p class='bad-notice'>Error: $invMake $invModel was not
deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    }
    break;

  case 'classification':

    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // get the vehicles
    $vehicles = getVehiclesByClassification($classificationName);

    if (!count($vehicles)) {
      $message = "<p class='bad-notice'>Sorry, no $classificationName could be found.</p>";
    } else {
      $vehicleDisplay = buildVehiclesDisplay($vehicles);
    };

    // echo $vehicleDisplay;
    // exit;
    include '../view/classification.php';

    break;

  case 'vehicle-info':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);

    $vehicle = getVehicle($invId);

    // validate if the vehicle exists
    if (!count($vehicle)) {
      $message = "<p class='bad-notice'>Sorry, no vehicle could be found.</p>";
    } else {
      $vehicleDisplay = buildVehicleDisplay($vehicle);
    };

    // echo $vehicleDisplay;
    // exit;
    include '../view/vehicle-detail.php';
    break;
  default:
    // functions to build classification list
    $classificationList = buildClassificationList($classifications);

    include '../view/vehicle-man.php';
    break;
}
