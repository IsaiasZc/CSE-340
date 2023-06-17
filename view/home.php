<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- normalize -->
  <!-- <link rel="stylesheet" href="./css/normalize.css"> -->

  <link rel="stylesheet" media="screen" href="./css/style.css">

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
    <main class="home_main">
      <section class="container home_hero">
        <h1>Welcome to PHP Motors!</h1>

        <div class="home_main_info">
          <p>
            <b>DMC Delorean</b>
            <br>
            3 Cup holders
            <br>
            Superman doors
            <br>
            Fuzzy dice!
          </p>

          <a class="home_own_link home_own_link-first" href="#">Own Today</a>
        </div>
      </section>

      <a class="home_own_link home_own_link-sec" href="#">Own Today</a>

      <section class="home_section home_reviews">
        <h2>DMC Delorean Reviews</h2>
        <ul class="home_reviews_list">
          <li>"So fast its almost linke traveling in time." (4/5)</li>
          <li>"Coolest on the road" (4/5)</li>
          <li>"I'm feeling Marty McFly!" (5/5)</li>
          <li>"The most futuristic ride of our day." (4.5/5)</li>
          <li>"80's livin and I love it!" (5/5)</li>
        </ul>
      </section>


      <section class="home_section home_upgrades">
        <h2>Delorean Upgrades</h2>
        <div class="upgrades_card">
          <div class="upg_card_img"><img src="./images/upgrades/flux-cap.png" alt="Flux Capacitor_imag_alt"></div>
          <a href="#">Flux Capacitor</a>
        </div>
        <div class="upgrades_card">
          <div class="upg_card_img"><img src="./images/upgrades/flame.jpg" alt="Flame_imag_alt"></div>
          <a href="#">Flame Decals</a>
        </div>
        <div class="upgrades_card">
          <div class="upg_card_img"><img src="./images/upgrades/bumper_sticker.jpg" alt="Bumper Sticker_imag_alt"></div>
          <a href="#">Bumper Sticker</a>
        </div>
        <div class="upgrades_card">
          <div class="upg_card_img"><img src="./images/upgrades/hub-cap.jpg" alt="Hub Caps_imag_alt"></div>
          <a href="#">Hub Caps</a>
        </div>
      </section>



    </main>
    <footer class="footer">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
  </div>
</body>

</html>