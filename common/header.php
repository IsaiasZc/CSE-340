<div class="d-flex justify-content-between align-items-center" id="top-header">
  <div id="logo">
    <a href="/phpmotors/index.php" title="PHP Motors Home Page">
      <img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo">
    </a>
  </div>
  <div class="account" id="account">
    <?php 

    // Replace the cookie-welcome message with a session-based welcome message
    if(isset($_SESSION['loggedin']))
    {
      echo "<a class='logged-welcome' href='/phpmotors/accounts/?action=admin'>".$_SESSION['clientData']['clientFirstname']."</a>";
      echo "<a href='/phpmotors/accounts/?action=Logout' title='Logout of your PHP Motors account'>Logout</a>";
    } else {
      echo "<a href='/phpmotors/accounts/?action=login' title='Login or Register with PHP Motors'>My Account</a>";
    }
      
    ?>

  </div>
</div>

