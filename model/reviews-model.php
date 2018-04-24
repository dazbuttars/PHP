<?php

/* 
 * Reviews-model
 */

// This function will handle inserting new Categories into the Category table.
function newReview($reviewText,$invId,$clientId) {
// Create a connection object using the acme connection function
$db = acmeConnect();
// The SQL statement
$sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
// Create the prepared statement using the acme connection
$stmt = $db->prepare($sql);
// The next line will replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
// Insert the data
$stmt->execute();
// Ask how many rows changed as a result of our insert
$rowsChanged = $stmt->rowCount();
// Close the database interaction
$stmt->closeCursor();
// Return the indication of success (rows changed)
return $rowsChanged;
}

// Get product information by invId
function getReviewInv($invId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM reviews WHERE invId = :invId ORDER BY reviewId DESC';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $prodInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo;
}

// Get product information by clientId
function getReviewClient($clientId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM reviews WHERE clientId = :clientId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
 $stmt->execute();
 $prodInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo;
}

function getReviewInfo($reviewId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
 $stmt->execute();
 $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo;
}

// This function will update a product
function updateReview($reviewText,$reviewId) {
    // Create a connection object using the acme connection function
$db = acmeConnect();
// The SQL statement
$sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
// Create the prepared statement using the acme connection
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT); 
// Insert the data
$stmt->execute();
// Ask how many rows changed as a result of our insert
$rowsChanged = $stmt->rowCount();
// Close the database interaction
$stmt->closeCursor();
// Return the indication of success (rows changed)
return $rowsChanged;
}

function deleteReview($reviewId) {
     $db = acmeConnect();
 $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}