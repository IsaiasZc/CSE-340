<?php

// Accounts Model PHP

function regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword){
  // Create a connection object using the phpmotors connection function
  $db = phpMotorsConnect();
  
  // The SQL statement
  $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
      VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is

  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->bindValue(':clientPassword', $hashedPassword, PDO::PARAM_STR);
  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
}

// This function will check for an existing email address in the clients table

function checkExistingEmail($clientEmail) {
  $db = phpMotorsConnect();
  $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();
  if(empty($matchEmail)){
    return 0;
  } 
  
  return 1;
}

// Get client data based on an email address
function getClient($clientEmail){
  $db = phpmotorsConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

function getClientById($clientId){
  $db = phpmotorsConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

// Update the client data based on the clientId
function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId) {
// Update the client record
  $db = phpmotorsConnect(); // Connect to the database
  $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId'; // SQL statement
  $stmt = $db->prepare($sql); // prepare the statement
  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR); // bind values to the placeholders
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR); // bind values to the placeholders
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR); // bind values to the placeholders
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); // bind values to the placeholders
  $stmt->execute(); // update the data
  $rowsChanged = $stmt->rowCount(); // get the number of rows changed
  $stmt->closeCursor(); // close the database connection
  return $rowsChanged; // return the number of rows changed
}

function updatePassword($clientPassword, $clientId) {
  $db = phpmotorsConnect(); // Connect to the database
  $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId'; // SQL statement
  $stmt = $db->prepare($sql); // prepare the statement
  $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR); // bind values to the placeholders
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); // bind values to the placeholders
  $stmt->execute(); // update the data
  $rowsChanged = $stmt->rowCount(); // get the number of rows changed
  $stmt->closeCursor(); // close the database connection
  return $rowsChanged; // return the number of rows changed
}