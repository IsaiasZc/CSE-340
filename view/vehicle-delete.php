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

  <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
      <h1 class="vehicles-title"><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>

      <?php
      // The isset() function tests the variable that is included as a parameter and "Returns TRUE if the variable exists and has a value other than NULL. Returns FALSE otherwise."
      if (isset($message)) {
        echo $message;
      }
      ?>

      <h2 class="add-vehicles-alert">Confirm Vehicle Deletion. The delete is permanent.</h2>

      <form class="flex-form" id="mofidy-vehicles-form" method="post" action="/phpmotors/vehicles/">
          <label for="invMake">Vehicle Make</label>
          <input type="text" readonly name="invMake" id="invMake" <?php
        if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

          <label for="invModel">Vehicle Model</label>
          <input type="text" readonly name="invModel" id="invModel" <?php
        if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

          <label for="invDescription">Vehicle Description</label>
          <textarea name="invDescription" readonly id="invDescription"><?php
        if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
        ?></textarea>

        <input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

          <input type="hidden" name="action" value="deleteVehicle">
          <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
        echo $invInfo['invId'];} ?>">

      </form>

    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>
</body>

</html>