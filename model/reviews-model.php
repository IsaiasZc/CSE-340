<?php
// reviews model

// function to insert a new review to the reviews table.
function regReview($reviewText, $invId, $clientId) {
  $db = phpMotorsConnect();
  $sql = 'INSERT INTO reviews ( reviewText, invId, clientId ) VALUES (:reviewText, :invId, :clientId)';
  $stmt = $db->prepare($sql);

  // Save the 
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  
  // Insert Data
  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}

// function to get reviews for a specific inventory item
function getReviewsByInvId($invId) {
  $db = phpMotorsConnect();
  $sql = 'SELECT * FROM reviews INNER JOIN clients ON reviews.clientId = clients.clientId WHERE invId = :invId';
  $stmt = $db->prepare($sql);

  $stmt->bindValue(':invId',$invId, PDO::PARAM_INT);

  $stmt->execute();

  $review = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $review;
}

// function to get reviews written by a specific client
function getReviewsByClientId($clientId) {
  $db = phpMotorsConnect();
  $sql = 'SELECT reviewDate, reviewId, invMake, invModel FROM reviews INNER JOIN inventory ON reviews.invId = inventory.invId WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);

  $stmt->bindValue(':clientId',$clientId, PDO::PARAM_INT);

  $stmt->execute();

  $review = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $review;
}

// function to get a specific review
function getReviewById($reviewId) {
  $db = phpMotorsConnect();
  $sql = 'SELECT reviewDate, reviewText, reviewId, invMake, invModel, clientId FROM reviews INNER JOIN inventory ON reviews.invId = inventory.invId WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);

  $stmt->bindValue(':reviewId',$reviewId, PDO::PARAM_INT);

  $stmt->execute();

  $review = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $review;

}

// function to update a specific review
function updateReview($reviewId, $reviewText) {
  $db = phpMotorsConnect();
  $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);

  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);

  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}

// function to delete a specific review
function deleteReview($reviewId) {
  $db = phpMotorsConnect();
  $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  
  return $rowsChanged;

}