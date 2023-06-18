<?php
// only allow access to this page if the user is logged in
if (!$_SESSION['loggedin']) {
  header('Location: /phpmotors/');
  exit;
}
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
    <main>
      <h1>Manage Account</h1>

      <?php
      if (isset($message)) {
        echo $message;
      }
      ?>
      <h2>Account Update</h2>
      <form method="post" action="/phpmotors/accounts/">
        <label for="clientFirstname">First Name:</label>
        <input type="text" id="clientFirstname" name="clientFirstname" value="<?php if(isset($clientInfo['clientFirstname'])){ echo $clientInfo['clientFirstname'];} ?>" required>

        <label for="clientLastname">Last Name:</label>
        <input type="text" id="clientLastname" name="clientLastname" value="<?php if(isset($clientInfo['clientLastname'])){ echo $clientInfo['clientLastname'];} ?>" required>

        <label for="clientEmail">Email:</label>
        <input type="email" id="clientEmail" name="clientEmail" value="<?php if(isset($clientInfo['clientEmail'])){ echo $clientInfo['clientEmail'];} ?>" required>

        <input type="hidden" name="action" value="updateAccount">
        <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} ?>">
        <input type="submit" value="Update Account">
      </form>

      <h2>Update Password</h2>
      <p>
        Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character
        <br>
        *Note your original password will be changed.
      </p>
      <form method="post" action="/phpmotors/accounts/">
        <label for="clientPassword">New Password:</label>
        <input type="password" id="clientPassword" name="clientPassword" autocomplete="off" required>

        <input type="hidden" name="action" value="updatePassword">
        <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} ?>">
        <input type="submit" value="Change Password">
      </form>
    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>
</body>

</html>