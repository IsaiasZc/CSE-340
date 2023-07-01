<?php
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
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

  <title>Image Management | PHP Motors</title>
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
      <h1>Image Management</h1>

      <h2>Add New Vehicle Image</h2>
      <?php
      if (isset($message)) {
        echo $message;
      } ?>

      <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
        <label for="invItem">Vehicle</label>
        <?php echo $prodSelect; ?>
        <fieldset>
          <label>Is this the main image for the vehicle?</label>
          <label for="priYes" class="pImage">Yes</label>
          <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
          <label for="priNo" class="pImage">No</label>
          <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
        </fieldset>
        <label>Upload Image:</label>
        <input type="file" name="file1">
        <input type="submit" class="regbtn" value="Upload">
        <input type="hidden" name="action" value="upload">
      </form>
      <hr>
      <h2>Existing Images</h2>
      <p class="bad-notice">If deleting an image, delete the thumbnail too and vice versa.</p>
      <?php
      if (isset($imageDisplay)) {
        echo $imageDisplay;
      } ?>
    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>
</body>

</html>
<?php unset($_SESSION['message']); ?>