<?php
// verify if the visitor is NOT logged in
if(!$_SESSION['loggedin']) {
  // if not logged in, send them to the main PHP Motors controller
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

  <title>Admin | PHP Motors</title>
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
    <main class="main-admin">
    <!-- User full name in h1 tag -->
    <h1><?php echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?></h1>

    <?php
      if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
      }
    ?>
    <p>You are logged in</p>
    <ul class="main-admin-info">
      <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
      <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
      <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
    </ul>

    <!-- Add the accounts managment -->
    <h2>Account Management</h2>

    <p>Use this link to update account information</p>
    <a class="main-inventory-link" href="/phpmotors/accounts/?action=client-update">Update Account Information</a>

    <?php 
      if ($_SESSION['clientData']['clientLevel'] > 1) {
        echo '<h2>Inventory Management</h2>';
        echo '<p>Use this link to manage the inventory</p>';
        echo '<a class="main-inventory-link" href="/phpmotors/vehicles/">Vehicle Management</a>';
      }
    ?>
    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>
</body>
</html>