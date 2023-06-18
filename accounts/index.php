<?php

//? Accounts Controller

// Create or access a Session
session_start();

// Get connection database file
require_once '../library/connections.php';
// Get the PHP Motors modewl for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// var_dump($classifications);
// exit;

// Build a navigation bar using the $classifications array
$navList = buildNavList($classifications);

// echo $navList;
// exit;



$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {

  case 'registration':
    include '../view/registration.php';
    // echo "hello";
    break;

  case 'login':
    include '../view/login.php';
    break;

  case 'register':
    // Filter and store the data
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $checkPassword = checkPassword($clientPassword);

    // check for existing email address in the table
    $existingEmail = checkExistingEmail($clientEmail);

    // Check for existing email address in the table
    if ($existingEmail) {
      $message = '<p class="bad-notice">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
    }

    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/registration.php';
      exit;
    }

    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    // Send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if ($regOutcome === 1) {
      setcookie('firstname', $clientFirstname, strtotime('+1 year'),'/');
      $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      header('Location: /phpmotors/accounts/?action=login');
      // include '../view/login.php';
      exit;
    } else {
      $_SESSION['message'] = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }

    break;
  case 'Login':
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $passwordCheck = checkPassword($clientPassword);
    
    // Run basic checks, return if errors
    if (empty($clientEmail) || empty($passwordCheck)) {
      $_SESSION['message'] = '<p class="bad-notice">Please provide a valid email address and password.</p>';
     include '../view/login.php';
     exit;
    }
      
    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    //! An error appears when the email does not exist in the database
    // Compare the password just submitted against
    // the hashed password for the matching client

    // echo $clientEmail;

    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if(!$hashCheck) {
      $message = '<p class="bad-notice">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view
    include '../view/admin.php';
    exit;
  
  case 'admin':

    // $clientData = $_SESSION['clientData'];
    include '../view/admin.php';
    break;
  
  case 'Logout':
    session_unset();
    session_destroy();
    header('Location: /phpmotors/');
    break;

  case 'client-update':
    $clientInfo = $_SESSION['clientData'];

    if(count($clientInfo) < 1){
      $message = '<p class="bad-notice">Sorry, no account information could be found.</p>';
    }
    include '../view/client-update.php';
    exit;
    break;

  case 'updateAccount':
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientInfo = $_SESSION['clientData'];


    $clientEmail = checkEmail($clientEmail);

    // validate if the email is the same of the session
    if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
      $existingEmail = checkExistingEmail($clientEmail);
      if ($existingEmail) {
        $message = '<p class="bad-notice">That email address already exists. Please try again.</p>';
        include '../view/client-update.php';
        exit;
      }
    }

    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/client-update.php';
      exit;
    }

    $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

    if ($updateResult) {
      $_SESSION['message'] = "<p class='notice'>Congratulations, $clientFirstname your account information was successfully updated.</p>";
      $_SESSION['clientData'] = getClientById($clientId);
      header('location: /phpmotors/accounts/?action=admin');
      exit;
    } else {
      $_SESSION['message'] = "<p class='bad-notice'>Error. The account information was not updated.</p>";
      include '../view/client-update.php';
      exit;
    }
    break;
  
  case 'updatePassword':
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $checkPassword = checkPassword($clientPassword);
    $clientInfo = $_SESSION['clientData'];

    if (empty($checkPassword)) {
      $message = '<p class="bad-notice">Please provide a valid password.</p>';
      include '../view/client-update.php';
      exit;
    }

    $clientData = getClient($clientInfo['clientEmail']);

    // verify if the password is the same of the session
    if (password_verify($clientPassword, $clientData['clientPassword'])) {
      $message = '<p class="bad-notice">The password is the same of the session. Please try again.</p>';
      include '../view/client-update.php';
      exit;
    }

    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    $updateResult = updatePassword($hashedPassword, $clientId);

    if ($updateResult) {
      $_SESSION['message'] = "<p class='notice'>Congratulations, your password was successfully updated.</p>";
      header('location: /phpmotors/accounts/?action=admin');
      exit;
    } else {
      $_SESSION['message'] = "<p class='bad-notice'>Error. The password was not updated.</p>";
      include '../view/client-update.php';
      exit;
    }
    break;

  default:
    include '../view/login.php';
    break;
}
