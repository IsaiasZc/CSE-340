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

  <title>Add Classification | PHP Motors</title>
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
    <main class="add-classification-main">
      <h1 class="add-classification-title">Add Car Classification</h1>

      <?php
      // The isset() function tests the variable that is included as a parameter and "Returns TRUE if the variable exists and has a value other than NULL. Returns FALSE otherwise."
        if (isset($message)) {
          echo $message;
        }
      ?>
      <form class="add-classification-form" id="add-classification-form" method="post" action="/phpmotors/vehicles/index.php">
        <label for="classificationName">
          <span>Classification Name</span>
          <input type="text" id="classificationName" name="classificationName" maxlength="30" required>
          <small>*This field is limited to 30 characters</small>
        </label>
        <input class="login-form-btn" type="submit" value="Add Classification" />

        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="classification">
      </form>
    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div> 
</body>
</html>