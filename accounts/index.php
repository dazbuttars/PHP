<?php

//Create or access a Session
session_start();

//AccountsController
// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';
require_once '../model/reviews-model.php';
require_once '../model/product-model.php';


// Get the array of categories
$categories = getCategories();
$navList = navList($categories);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include '../view/login.php';
        exit;
    case 'registration':
        include '../view/registration.php';
        exit;
    case 'register':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        $checkEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        
        break;
    case 'Login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $EmailCheck = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $passwordCheck = checkPassword($clientPassword);
        
         setcookie('firstname', null, strtotime('-1 year'), '/');
            
// Run basic checks, return if errors
        if (empty($EmailCheck) || empty($passwordCheck)) {
            $message = '<p class="notice">Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }

// A valid password exists, proceed with the login process
// Query the client data based on the email address
        $clientData = getClient($clientEmail);
// Compare the password just submitted against
// the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
// If the hashes don't match create an error
// and return to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
// A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
// Remove the password from the array
// the array_pop function removes the last
// element from an array
        array_pop($clientData);
// Store the array into the session
        $_SESSION['clientData'] = $clientData;
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
         // Send them to the admin view
        $message =' ';
        
         $clientId = $_SESSION['clientData']['clientId'];
        $reviewClient = getReviewClient($clientId);
        
              
        
        $manageProductReviews = buildManageProductReviewsView($reviewClient);
        
        include '../view/admin.php';
        exit;
    case 'Logout':
        session_destroy();
        header('Location: /acme/index.php');
        exit;
        
    case 'clientUpdate':
        $clientId = $_SESSION['clientData']['clientId'];
       $clientInfo = getclientInfo($clientId);
        include '../view/client-update.php';
        exit;
        break;
        
    case 'updateInfo':
         // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = $_SESSION['clientData']['clientId'];
        
        $checkEmail = checkEmail($clientEmail);
        // Run basic checks, return if errors
        if (empty($checkEmail)) {
            $message = '<p class="notice">Please provide a valid email address.</p>';
            include '../view/client-update.php';
            exit;
        }

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($checkEmail)) {
         $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
        exit;
        }
        $updateInfo = updateInfo($clientFirstname, $clientLastname, $checkEmail, $clientId);
        if ($updateInfo) {
           $message = "<p class='notify'>Congratulations your account was successfully updated.</p>";
           $clientData = getClient($clientEmail);
           $_SESSION['clientData'] = $clientData;
            include '../view/admin.php';
            exit;
        } else {
            $message = "<p>Error. The $clientFirstname $clientLastname account was not updated.</p>";
            include '../view/client-update.php';
            exit;
        }
        exit;
        
    case 'updatePassword':
         // Filter and store the data
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = $_SESSION['clientData']['clientId'];
        
        $checkPassword = checkPassword($clientPassword);
        // Run basic checks, return if errors
        if (empty($checkPassword)) {
            $message = '<p class="notice">Please provide a valid password.</p>';
            include '../view/client-update.php';
            exit;
        }

        
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        
        
        // Check for missing data
if (empty($clientPassword)) {
    $message = '<p>No password entered.</p>';
    include '../view/client-update.php';
        exit;
        }
        $updatePassword = updatePassword($hashedPassword, $clientId);
        if ($updatePassword) {
           $message = "<p class='notify'>Congratulations, your password was successfully updated.</p>";
            include '../view/admin.php';
            exit;
        } else {
            $message = "<p>Error. The Password was not updated.</p>";
                include '../view/client-update.php';
            exit;
        }
        exit;
        
    case 'admin':
        
                $clientId = $_SESSION['clientData']['clientId'];
        $reviewClient = getReviewClient($clientId);
        
             
        
        $manageProductReviews = buildManageProductReviewsView($reviewClient);
        
        include '../view/admin.php';
        exit;
        
     default :
      $message =' ';  
         
        $clientId = $_SESSION['clientData']['clientId'];
        $reviewClient = getReviewClient($clientId);
        
              
        
        $manageProductReviews = buildManageProductReviewsView($reviewClient);
         
      include '../view/admin.php';
      exit;
}


// Check for an existing emal address
$existingEmail = checkExistingEmail($clientEmail);
if ($existingEmail) {
    $message = '<p class="notice"> That email address us already used. Do you want to login instead?</p>';
    include '../view/login.php';
    exit;
}



// Check for missing data
if (empty($clientFirstname) || empty($clientLastname) || empty($checkEmail) ||
        empty($checkPassword)) {
    $message = '<p>Please provide information for all empty form fields.</p>';
    include '../view/registration.php';
    exit;
}

// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

//Send the data to the model
$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

// Check and report the result
if ($regOutcome === 1) {
    setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
    $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
    include '../view/login.php';
    exit;
} else {
    $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
    include '../view/registration.php';
    exit;
}
 