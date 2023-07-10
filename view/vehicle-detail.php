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

  <title><?php echo $vehicle['invMake'] .' '. $vehicle['invModel']; ?> | PHP Motors, Inc.</title>
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
    <h1><?php echo $vehicle['invMake'] .' '. $vehicle['invModel']; ?></h1>
      <?php if (isset($message)) {
        echo $message;
      }
      ?>
      <section class="vhc-main-cnt">
      <?php if (isset($thumbnailsDisplay)) {
        echo $thumbnailsDisplay;
      } ?>

      <h2 class="vhc-main_thumb-title">Vehicle Thumbnails</h2>

      <?php if (isset($vehicleDisplay)) {
        echo $vehicleDisplay;
      } ?>
      </section>

      <section class="rvw-cnt">

        <h2>Customer Review</h2>
        <?php
          if (!isset($_SESSION['loggedin'])) {
            echo '<p>You must <a href="/phpmotors/accounts/?action=login">login</a> to write a review.</p>';
          } else {

            $clientInfo = $_SESSION['clientData'];
            
            $reviewHTML = '<form class="stnd-form" method="post" action="/phpmotors/reviews/">';
            $reviewHTML .= '<label id="reviewName">Screen Name:</label>';
            $reviewHTML .= '<input id="reviewName" type="text" name="name" value="'.$_SESSION['clientData']['clientFirstname'].'" disabled/>';
            $reviewHTML .= '';
            $reviewHTML .= '<label for="reviewText">Review:</label>';
            $reviewHTML .= '<textarea id="reviewText" name="reviewText"></textarea>';
            if (isset($clientInfo['clientId'])) {
              $reviewHTML .= '<input type="hidden" name="clientId" value="' . $clientInfo['clientId'] . '">';
            }
            if (isset($invId)) {
              $reviewHTML .= '<input type="hidden" name="invId" value="' . $invId . '">';
            }
            $reviewHTML .= '<input type="hidden" name="action" value="addReview">';
            $reviewHTML .= '<input type="submit">Submit Review</input>';
            $reviewHTML .= '</form>';

            echo $reviewHTML;
          };
        ?>

        <?php
          if (isset($reviewsDisplay)) {
            echo $reviewsDisplay;
          } else {
            echo '<p>Be the first to write a review.</p>';
          }
        ?> 
      </section>
    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>
</body>
</html>