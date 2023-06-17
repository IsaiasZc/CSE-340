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
    <main class="register-main">
      <h1 class="register-title">Register</h1>

      <?php
      // The isset() function tests the variable that is included as a parameter and "Returns TRUE if the variable exists and has a value other than NULL. Returns FALSE otherwise."
        if (isset($message)) {
          echo $message;
        }
      ?>
      <form class="form-validation" id="register-form" method="post" action="/phpmotors/accounts/index.php"> <!-- Create the POST method and the action -->
        <label for="clientFirstName">
          First Name
          <input type="text" id="fname" name="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required>
        </label>

        <label for="clientLastName">
          Last Name
          <input type="text" id="lname" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required>
        </label>

        <!-- Create 2 more labels with Email and Password -->
        <label for="clientEmail">
          Email
          <input type="email" id="Email" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
        </label>

        <label for="clientPassword">
          Password
          <small>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</small> 
          <input type="password" name="clientPassword" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
        </label>
        <!-- <small>Passwords must be at least 1 number, 1 capital letter and 1 special character</small> -->

        <input type="submit" name="submit" id="regbtn" value="register" >

        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="register">
      </form>


    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>
</body>
</html>