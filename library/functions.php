<?php

function checkEmail($clientEmail)
{
  $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
  return $valEmail;
}

function checkPassword($clientPassword)
{
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
  return preg_match($pattern, $clientPassword);
}

function checkClassificationName($classificationName)
{

  $pattern = '/^.{1,30}$/';

  return preg_match($pattern, $classificationName);
}

function buildClassificationList($classifications)
{

  $classificationList = '<select name="classificationId" id="classificationList">';
  $classificationList .= "<option>Choose a Classification</option>";
  foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    $classificationList .= ">$classification[classificationName]</option>";
  }
  $classificationList .= '</select>';
  // echo $classificationList;
  return $classificationList;
}

function buildNavList($classifications)
{


  // Build a navigation bar using the $classifications array
  $navList = "<ul class='nav_list d-flex'>";
  $navList .= "<li><a class='nav_links' href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
    $navList .= "<li><a class='nav_links' href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';
  return $navList;
};