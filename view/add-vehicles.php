<?php
// checks that a client is "loggedin" AND has a clientLevel greater than "1" to access the view.
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
  header('Location: /phpmotors/');
  exit;
}
?><!DOCTYPE html>
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

  <title>Vehicles | PHP Motors</title>
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
      <h1 class="vehicles-title">Add Vehicle</h1>

      <?php
      // The isset() function tests the variable that is included as a parameter and "Returns TRUE if the variable exists and has a value other than NULL. Returns FALSE otherwise."
        if (isset($message)) {
          echo $message;
        }
      ?>

      <h2 class="add-vehicles-alert">*Note all Fields are Required</h2>

      <form class="add-vehicles-form" id="add-vehicles-form" method="post" action="/phpmotors/vehicles/index.php">
        <label for="classificationList">
          <?php echo $classificationList; ?>
        </label>

        <label for="make">
          <span>Make</span>
          <input type="text" id="make" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";}  ?> required>
        </label>

        <label for="model">
          <span>Model</span>
          <input type="text" id="model" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";}  ?> required>
        </label>

        <label for="description">
          <span>Description</span>
          <textarea id="description" name="invDescription" required><?php if(isset($invDescription)){echo "$invDescription";}  ?></textarea>
        </label>

        <label for="image">
          <span>Image Path</span>
          <input type="text" id="image" name="invImage" value="/phpmotors/images/no-image.png" required>
        </label>

        <label for="thumbnail">
          <span>Thumbnail Path</span>
          <input type="text" id="thumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png" required>
        </label>

        <label for="price">
          <span>Price</span>
          <input type="number" id="price" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required>
        </label>

        <label for="stock">
          <span>Stock</span>
          <input type="number" id="stock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> required>
        </label>

        <label for="color">
          <span>Color</span>
          <input type="text" id="color" name="invColor"  <?php if(isset($invColor)){echo "value='$invColor'";}  ?> required>
        </label>

        <input class="login-form-btn" type="submit" value="Add Vehicle" />

        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="vehicles">
      </form>

    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>
</body>
</html>