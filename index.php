<?php

// Create or access a Session
session_start();

// Get connection database file
require_once 'library/connections.php';
// Get the PHP Motors modewl for use as needed
require_once 'model/main-model.php';
// Require the functions library
require_once 'library/functions.php';

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

// verify the existence of the cookie

if(isset($_COOKIE['firstname'])) {
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {
  case 'template':
    include 'view/template.php';
    break;

  default:
    include 'view/home.php';
};
