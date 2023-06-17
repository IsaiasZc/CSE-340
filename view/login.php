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

  <title>Content Title | PHP Motors</title>
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
    <main class="login-main">
      <h1 class="login-title">Sign in</h1>

      <?php
      // The isset() function tests the variable that is included as a parameter and "Returns TRUE if the variable exists and has a value other than NULL. Returns FALSE otherwise."
      if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
      }
      ?>
      <form class="login-form form-validation" id="login-form" method="post" action="/phpmotors/accounts/">
        <label for="userEmail">
          Email
          <input type="email" id="clientEmail" name="clientEmail" <?php if (isset($userEmail)) { echo "value='$userEmail'"; }  ?> required>
        </label>
        <label for="userPassword">
          Password
          <input type="password" id="clientPassword" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
        </label>
        <input class="login-form-btn" type="submit" value="login">

        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="Login">
      </form>

      <a href="/phpmotors/accounts/?action=registration" id="goToRegister" class="goToRegister">Not a member yet?</a>
    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>
</body>

</html>