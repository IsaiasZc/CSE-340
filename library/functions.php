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
  $navList .= "<li><a class='nav_links' href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
    $navList .= "<li><a class='nav_links' href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';
  return $navList;
};

function getVehiclesByClassification($classificationName)
{
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
  $stmt->execute();
  $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $vehicles;
}

function buildVehiclesDisplay($vehicles)
{
  $dv = '<ul id="inv-display">';
  foreach ($vehicles as $vehicle) {
    $dv .= '<li><a href="/phpmotors/vehicles/?action=vehicle-info&invId='.urlencode($vehicle['invId']).'">';
    $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= '<hr>';
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
    $dv .= "<span>$vehicle[invPrice]</span>";
    $dv .= '</a></li>';
  }

  $dv .= '</ul>';
  return $dv;
}

function buildVehicleDisplay($vehicle)
{
  $dv = '<div class="vehicle-display">';
  $dv .= '<div class="vehicle-display-img">';
  $dv .= "<img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
  $dv .= '</div>';
  $dv .= '<div class="vehicle-display-info">';
  $dv .= "<h2>$vehicle[invMake] $vehicle[invModel] Details</h2>";
  $dv .= "<p>$vehicle[invDescription]</p>";
  $dv .= "<p>Color: $vehicle[invColor]</p>";
  $dv .= "<p># in Stock: $vehicle[invStock]</p>";
  $dv .= '</div>';
  $dv .= '<p class="vehicle-display-price">Price: $'.$vehicle['invPrice'].'</p>';
  $dv .= '</div>';
  return $dv;
}