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

    $currentPath = 'location: /phpmotors/vehicles/?action=vehicle-info&invId='.$invId.'&reviewed=1';

    if (empty($reviewText)) {
      $revMessage = 1;
      header("location: /phpmotors/vehicles/?action=vehicle-info&invId=$invId&revMessage=$revMessage");
      exit;
    }

    $regOutcome = regReview($reviewText, $invId, $clientId);

    if ($regOutcome === 1) {
      $message = "<p class='notice'> Review Added.</p>";
    } else {
      $message = "<p class='bad-notice'>There was an error. Please try again.</p>";
      header("location: /phpmotors/vehicles/?action=vehicle-info&invId=$invId");
      exit;
    }

    header('location: /phpmotors/vehicles/?action=vehicle-info&invId='.$invId.'&reviewed=1');
    exit;

    break;

  case 'edit':

    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);


    $review = getReviewById($reviewId);

    $reviewDate = makeReviewDate($review['reviewDate']);

    include '../view/review-edit.php';

    break;

  case 'updateReview':

    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    if (empty($reviewId) || empty($reviewText)) {
      $message = '<p class="notice"> The Review needs to be filled </p>';
      include '../view/review-edit.php';
      exit;
    }

    $updatedReview = updateReview($reviewId, $reviewText);

    if($updatedReview) {
      $message = '<p class="notice">The Review was updated succesfully.</p>';
      $_SESSION['message'] = $message;
      header('location: /phpmotors/accounts/?action=admin');

      exit;
    } else {
      $message = '<p class="bad-notice"></p>';
      $_SESSION['message'] = $message;
      header('location: /phpmotors/accounts/?action=admin');

      exit;

    }

    break;
  
  case 'del':
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $review = getReviewById($reviewId);

    $reviewDate = makeReviewDate($review['reviewDate']);

    include '../view/review-delete.php';

    break;
  
  case 'deleteReview':
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $deleteResult = deleteReview($reviewId);
    
    if($deleteResult) {
      $message = '<p class="notice">The Review was deleted succesfully.</p>';
      $_SESSION['message'] = $message;
      header('location: /phpmotors/accounts/?action=admin');

      exit;
    } else {
      $message = '<p class="bad-notice">Error: The Review was not deleted.</p>';
      $_SESSION['message'] = $message;
      header('location: /phpmotors/accounts/?action=admin');

      exit;
    }

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