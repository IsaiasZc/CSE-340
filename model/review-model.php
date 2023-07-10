<?php
// reviews model

// function to insert a new review to the reviews table.
function regReview($reviewText, $invId, $clientId) {
  $db = phpMotorsConnect();
  $sql = 'INSERT INTO reviews ( reviewText, invId, clientId ) VALUES (:reviewText, :invid, :clientId)';
  $stmt = $db->prepare($sql);

  // Save the 
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
}

// function to get reviews for a specific inventory item
function getReviewsByInvId() {

}

// function to get reviews written by a specific client
function getReviewsByClientId() {

}

// function to get a specific review
function getReviewById() {

}

// function to update a specific review
function updateReview() {

}

// function to delete a specific review
function deleteReview() {

}