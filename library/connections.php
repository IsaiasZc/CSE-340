<?php

/**
 * Proxy connection to the phpmotors database
 */

function phpMotorsConnect() {
  $server = 'localhost';
  $dbname = 'phpmotors';
  $username = 'iClient';
  $password = 'KaLI1usArED3';
  $dsn = "mysql:host=$server;dbname=$dbname";
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

  try {
    $link = new PDO($dsn, $username, $password, $options);
    // if(is_object($link)) {
    //    echo 'It worked!';
    // }
    return $link;
  } catch (PDOException $e) {
    header('Location: /phpmotors/view/500.php');
    exit;
  }
}

phpMotorsConnect();