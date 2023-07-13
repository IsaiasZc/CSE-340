<?php
// verify if the visitor is NOT logged in or if the clientId of the review does not match the clientId in session
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientId'] != $review['clientId']) {
  // if not logged in or clientId does not match, send them to the main PHP Motors controller
  header('Location: /phpmotors/');
  echo $_SESSION['clientData']['clientId'];
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

  <title>Review Update | PHP Motors</title>
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
      <h1><?php echo "$review[invMake] $review[invModel]" ?> Review</h1>

      <p>Reviewed on <?php echo $reviewDate ?></p>

      <form class="stnd-form review-edit-form" method="post" action="/phpmotors/reviews/">
      
        <label for="reviewText">Review Text</label>
        
        <textarea name="reviewText" id="reviewText" cols="30" rows="10" required><?php echo $review['reviewText'] ?></textarea>

        <input type="submit" value="Update">

        <input type="hidden" name="action" value="updateReview">
        <input type="hidden" name="reviewId" value="<?php if(isset($review['reviewId'])) {echo $review['reviewId'];}; ?>">
      </form>
    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>
</body>
</html>