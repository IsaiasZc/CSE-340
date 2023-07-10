<?php
// checks that a client is "loggedin" AND has a clientLevel greater than "1" to access the view.
if ($_SESSION['clientData']['clientLevel'] < 2) {
  header('location: /phpmotors/');
  exit;
}
if(isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
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
    <main class="stnd-main">
      <h1 class="login-title">Vehicles Management</h1>

      <ul class="v-man-list">
        <li><a href="/phpmotors/vehicles/?action=addClassificationView">Add Classification</a></li>
        <li><a href="/phpmotors/vehicles/?action=addVehicles">Add Vehicles</a></li>
      </ul>

      <?php
      if (isset($message)) {
        echo $message;
      }
      if (isset($classificationList)) {
        echo '<h2>Vehicles By Classification</h2>';
        echo '<p>Choose a classification to see those vehicles</p>';
        echo $classificationList;
      }
      ?>

      <noscript>
        <p><strong>JavaScript Must Be Enabled to use this Page</strong></p> 
      </noscript>

      <!-- Table element -->
      <table id="inventoryDisplay"></table>
    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>

  <script src="../js/inventory.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>