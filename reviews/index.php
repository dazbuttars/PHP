<?php

//This is the reviews controller
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the functions library
require_once '../library/functions.php';

require_once '../model/reviews-model.php';
require_once '../model/product-model.php';
require_once '../model/uploads-model.php';
require_once '../model/accounts-model.php';


// Get the array of categories
$categories = getCategories();
$navList = navList($categories);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}


switch ($action) {
    case 'newReview':
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        newReview($reviewText, $invId, $clientId);

        $products = getProductInfo($invId);
        $thumb = getThumb($invId);
        if (empty($products)) {
            $prodView = "<p class='notice'>Sorry, something went wrong!</p>";
        } else {
            $prodView = buildProductsView($products);
            $thumbProdView = buildThumbView($thumb);
            if(isset($_SESSION['clientData'])){
            $firstname = $_SESSION['clientData']['clientFirstname'];
            $firstL = substr($firstname, 0, 1);
            $lastname = $_SESSION['clientData']['clientLastname'];
            }

            $reviewInv = getReviewInv($invId);
            $reviewView = buildReviewView($reviewInv); //$rv;
        }

        include '../view/product-detail.php';
        exit;
    case 'editReview':
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $reviewInfo = getReviewInfo($reviewId);
        $invId = $reviewInfo['invId'];
        $prodInfo = getProductInfo($invId);
        $invName = $prodInfo['invName'];
        if (count($prodInfo) < 1) {
            $message = 'Sorry, that review could not be found.';
        }

        include '../view/review-update.php';
                exit;
        
    case 'updateReview':
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        if (empty($reviewText) || empty($reviewId)) {
            echo $reviewText;
            echo $reviewId;
            $invName = '<p>Please complete all information for the updated review!</p>';
            include '../view/review-update.php';
            exit;
            
        } $updateResult = updateReview($reviewText,$reviewId);
        if ($updateResult) {
            $message = "<p class='notify'>Congratulations, The review was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/reviews/');
            exit;
        } else {
            $invName = "<p>Error. The review was not updated.</p>";
            include '../view/review-update.php';
            exit;
        }
        exit;
    case 'deleteReview':
$reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $reviewInfo = getReviewInfo($reviewId);
        $invId = $reviewInfo['invId'];
        $prodInfo = getProductInfo($invId);
        $invName = $prodInfo['invName'];
        if (count($prodInfo) < 1) {
            $message = 'Sorry, that review could not be found.';
        }

        include '../view/review-delete.php';
        exit;
    case 'delete':
       $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteReview($reviewId);
        if ($deleteResult) {
            $message = "<p class='notify'>Congratulations, The review was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/reviews/');
            exit;
        } else {
            $message = "<p>Error. The review was not deleted.</p>";
            include '../view/review-delete.php';
            exit;
        }
        exit;
    default :
       $clientId = $_SESSION['clientData']['clientId'];
        $reviewClient = getReviewClient($clientId);
        
              
        
        $manageProductReviews = buildManageProductReviewsView($reviewClient); //$mpr;
         
      include '../view/admin.php';
      exit;
}