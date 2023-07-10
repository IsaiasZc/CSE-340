<?php

//? reviews controller

session_start();

// get resources
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = buildNavList($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {
  case 'addReview':
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    echo $reviewText;
    echo $clientId;
    echo $invId;

    $regOutcome = regReview($reviewText, $invId, $clientId);

    if ($regOutcome === 1) {
      echo "<p>Se pudo :')</p>";
    } else {
      echo "<p>F mano</p>";
    }

    include '../view/admin.php';
    exit;

    break;

  case 'editReview':

    break;

  case 'updateReview':

    break;
  
  case 'deleteReview':

    break;

  

  default:

  // deliver to the admin view if logged in, otherwise deliver to the home view

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include '../view/admin.php';
    exit;
  } else {
    include '../view/home.php';
    exit;
  }

  break;
}