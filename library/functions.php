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


function buildVehiclesDisplay($vehicles)
{
  $dv = '<ul id="inv-display">';
  foreach ($vehicles as $vehicle) {
    $dv .= '<li><a href="/phpmotors/vehicles/?action=vehicle-info&invId=' . urlencode($vehicle['invId']) . '">';
    $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
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
  $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
  $dv .= '</div>';
  $dv .= '<div class="vehicle-display-info">';
  $dv .= "<h2>$vehicle[invMake] $vehicle[invModel] Details</h2>";
  $dv .= "<p>$vehicle[invDescription]</p>";
  $dv .= "<p>Color: $vehicle[invColor]</p>";
  $dv .= "<p># in Stock: $vehicle[invStock]</p>";
  $dv .= '</div>';
  $dv .= '<p class="vehicle-display-price">Price: $' . number_format($vehicle['invPrice'],2,".",",") . '</p>';
  $dv .= '</div>';
  return $dv;
}


/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image)
{
  $i = strrpos($image, '.');
  $image_name = substr($image, 0, $i);
  $ext = substr($image, $i);
  $image = $image_name . '-tn' . $ext;
  return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray)
{
  $id = '<ul id="image-display">';
  foreach ($imageArray as $image) {
    $id .= '<li>';
    $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
    $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
    $id .= '</li>';
  }
  $id .= '</ul>';
  return $id;
}

// Build the vehicles select list
function buildVehiclesSelect($vehicles)
{
  $prodList = '<select name="invId" id="invId">';
  $prodList .= "<option>Choose a Vehicle</option>";
  foreach ($vehicles as $vehicle) {
    $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
  }
  $prodList .= '</select>';
  return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name)
{
  // Gets the paths, full and local directory
  global $image_dir, $image_dir_path;
  if (isset($_FILES[$name])) {
    // Gets the actual file name
    $filename = $_FILES[$name]['name'];
    if (empty($filename)) {
      return;
    }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
  }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename)
{
  // Set up the variables
  $dir = $dir . '/';

  // Set up the image path
  $image_path = $dir . $filename;

  // Set up the thumbnail image path
  $image_path_tn = $dir . makeThumbnailName($filename);

  // Create a thumbnail image that's a maximum of 200 pixels square
  resizeImage($image_path, $image_path_tn, 200, 200);

  // Resize original to a maximum of 500 pixels square
  resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height)
{

  // Get image type
  $image_info = getimagesize($old_image_path);
  $image_type = $image_info[2];

  // Set up the function names
  switch ($image_type) {
    case IMAGETYPE_JPEG:
      $image_from_file = 'imagecreatefromjpeg';
      $image_to_file = 'imagejpeg';
      break;
    case IMAGETYPE_GIF:
      $image_from_file = 'imagecreatefromgif';
      $image_to_file = 'imagegif';
      break;
    case IMAGETYPE_PNG:
      $image_from_file = 'imagecreatefrompng';
      $image_to_file = 'imagepng';
      break;
    default:
      return;
  } // ends the swith

  // Get the old image and its height and width
  $old_image = $image_from_file($old_image_path);
  $old_width = imagesx($old_image);
  $old_height = imagesy($old_image);

  // Calculate height and width ratios
  $width_ratio = $old_width / $max_width;
  $height_ratio = $old_height / $max_height;

  // If image is larger than specified ratio, create the new image
  if ($width_ratio > 1 || $height_ratio > 1) {

    // Calculate height and width for the new image
    $ratio = max($width_ratio, $height_ratio);
    $new_height = round($old_height / $ratio);
    $new_width = round($old_width / $ratio);

    // Create the new image
    $new_image = imagecreatetruecolor($new_width, $new_height);

    // Set transparency according to image type
    if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
    }

    if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
    }

    // Copy old image to new image - this resizes the image
    $new_x = 0;
    $new_y = 0;
    $old_x = 0;
    $old_y = 0;
    imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

    // Write the new image to a new file
    $image_to_file($new_image, $new_image_path);
    // Free any memory associated with the new image
    imagedestroy($new_image);
  } else {
    // Write the old image to a new file
    $image_to_file($old_image, $new_image_path);
  }
  // Free any memory associated with the old image
  imagedestroy($old_image);
} // ends resizeImage function

// build thumbnails view
function buildThumbnailsDisplay($thumbnails)
{
  $thumbView = '<ul id="thumbnails-display" class="thumbnails-display">';
  foreach ($thumbnails as $thumbnail) {
    $thumbView .= '<li>';
    $thumbView .= "<img src='$thumbnail[imgPath]' alt='$thumbnail[invMake] $thumbnail[invModel] image on PHP Motors.com'>";
    $thumbView .= '</li>';
  }
  $thumbView .= '</ul>';
  return $thumbView;
}

function makeReviewDate($reviewDate) {
  $date = strtotime($reviewDate);
  $formatted_date = date('j F, Y', $date);

  return $formatted_date;
}

function buildReviewsDisplay($reviews) {
  $reviewView = '<ul id="reviews-display" class="reviews-display">';

  foreach ($reviews as $review) {

    $formatted_date = makeReviewDate($review['reviewDate']);

    $reviewView .= '<li>';
    $reviewView .= "<span>".substr($review['clientFirstname'],0,1)."$review[clientLastname] wrote on $formatted_date</span>";
    $reviewView .= "<p>$review[reviewText]</p>";
    $reviewView .= '</li>';
  }
  $reviewView .= '</ul>';
  return $reviewView;
}

function buildProductReviewDisplay($reviews) {
  $reviewView = '<ul id="product-rvw-display" class="product-rvw-display">';

  foreach ($reviews as $review) {

    $formatted_date = makeReviewDate($review['reviewDate']);

    $reviewView .= '<li>';
    $reviewView .= "$review[invMake] $review[invModel] (Reviewed on $formatted_date): ";
    $reviewView .= "<a href='/phpmotors/reviews/?action=edit&reviewId=".urlencode($review['reviewId'])."'>Edit</a>";
    $reviewView .= " | ";
    $reviewView .= "<a href='/phpmotors/reviews/?action=del&reviewId=".urlencode($review['reviewId'])."'>Delete</a>";
    $reviewView .= '</li>';
  }
  $reviewView .= '</ul>';
  return $reviewView;
}