<?php
// checks that a client is "loggedin" AND has a clientLevel greater than "1" to access the view.
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
  header('Location: /phpmotors/');
  exit;
}

// Build the classifications option list
$classifList = '<select name="classificationId" id="classificationId">';
$classifList .= "<option>Choose a Car Classification</option>";
foreach ($classifications as $classification) {
  $classifList .= "<option value='$classification[classificationId]'";
  if(isset($classificationId)){
  if($classification['classificationId'] === $classificationId){
    $classifList .= ' selected ';
  }
  } elseif(isset($invInfo['classificationId'])){
  if($classification['classificationId'] === $invInfo['classificationId']){
  $classifList .= ' selected ';
  }
}
$classifList .= ">$classification[classificationName]</option>";
}
$classifList .= '</select>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- normalize -->
  <!-- <link rel="stylesheet" href="./css/normalize.css"> -->

  <link rel="stylesheet" media="screen" href="../css/style.css">

  <!-- Fonts from google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">

  <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Modify $invInfo[invMake] $invInfo[invModel]";
          } elseif (isset($invMake) && isset($invModel)) {
            echo "Modify $invMake $invModel";
          } ?> | PHP Motors</title>
</head>

<body>
  <div class="wrapper" id="wrapper">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

    </header>
    <nav>
      <!-- <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?> -->
      <?php echo $navList; ?>
    </nav>
    <main class="vehicles-main">
      <h1 class="vehicles-title"><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
        echo "Modify $invInfo[invMake] $invInfo[invModel]";
      } elseif (isset($invMake) && isset($invModel)) {
        echo "Modify$invMake $invModel";
      } ?></h1>

      <?php
      // The isset() function tests the variable that is included as a parameter and "Returns TRUE if the variable exists and has a value other than NULL. Returns FALSE otherwise."
      if (isset($message)) {
        echo $message;
      }
      ?>

      <h2 class="add-vehicles-alert">*Note all Fields are Required</h2>

      <form class="add-vehicles-form" id="mofidy-vehicles-form" method="post" action="/phpmotors/vehicles/index.php">
        <label for="classificationId">
          <?php echo $classifList; ?>
        </label>

        <label for="make">
          <span>Make</span>
          <input type="text" name="invMake" id="invMake" required <?php if (isset($invMake)) {
            echo "value='$invMake'";
          } elseif (isset($invInfo['invMake'])) {
            echo "value='$invInfo[invMake]'";
          } ?> required>
        </label>

        <label for="model">
          <span>Model</span>
          <input type="text" name="invModel" id="invModel" required <?php if (isset($invModel)) {
            echo "value='$invModel'";
          } elseif (isset($invInfo['invModel'])) {
            echo "value='$invInfo[invModel]'";
          } ?> required>
</label>

        <label for="description">
          <span>Description</span>
          <textarea id="description" name="invDescription" required><?php if(isset($invDescription)){
            echo $invDescription;
          } elseif(isset($invInfo['invDescription'])) {
            echo $invInfo['invDescription']; 
          }?></textarea>
        </label>

        <label for="image">
          <span>Image Path</span>
          <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png" required>
        </label>

        <label for="thumbnail">
          <span>Thumbnail Path</span>
          <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png" required>
        </label>

        <label for="price">
          <span>Price</span>
          <input type="text" name="invPrice" id="invPrice" required <?php if (isset($invPrice)) {
            echo "value='$invPrice'";
          } elseif (isset($invInfo['invPrice'])) {
            echo "value='$invInfo[invPrice]'";
          } ?> required>
        </label>

        <label for="stock">
          <span>Stock</span>
          <input type="text" name="invStock" id="invStock" required <?php if (isset($invStock)) {
            echo "value='$invStock'";
          } elseif (isset($invInfo['invStock'])) {
            echo "value='$invInfo[invStock]'";
          } ?> required>
        </label>

        <label for="color">
          <span>Color</span>
          <input type="text" name="invColor" id="invColor" required <?php if (isset($invColor)) {
            echo "value='$invColor'";
          } elseif (isset($invInfo['invColor'])) {
            echo "value='$invInfo[invColor]'";
          } ?> required>
        </label>

        <input class="login-form-btn" type="submit" value="Update Vehicle" />

        <!-- Modifying the action name - value pair -->
        <input type="hidden" name="action" value="updateVehicle">
      </form>

    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>
</body>

</html>