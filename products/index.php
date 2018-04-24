<?php

//Create or access a Session
session_start();

//AccountsController
// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model
require_once '../model/product-model.php';
// Get the functions library
require_once '../library/functions.php';
require_once '../model/uploads-model.php';
require_once '../model/reviews-model.php';
require_once '../model/accounts-model.php';

// Get the array of categories
$categories = getCategories();
$navList = navList($categories);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}


//echo $catList;
//exit;

switch ($action) {
    case 'newCat':
        include '../view/add_category.php';
        exit;
    case 'newProd':
        include '../view/add_product.php';
        exit;
    case 'subCat':
        // Filter and store the data
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
        /*         * *************************************************************************** */
// Check for missing Category data
        /*         * **************************************************************************** */
        if (empty($categoryName)) {
            $message = '<p class="warning">Please provide information for all empty form fields.</p>';
            include '../view/add_category.php';
            exit;
        }

//Send the data to the model
        $catOutcome = newCategory($categoryName);

// Check and report the result
        if ($catOutcome === 1) {
            include '../view/product.php';
            header("Refresh:0");
            exit;
        } else {
            $message = "<p>It didn't work!!!!</p>";
            include '../view/add_category.php';
            exit;
        }
        break;
    case 'subProd':
        // Filter and store the data
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

        $checkPrice = checkPrice($invPrice);
        $checkStock = checkInt($invStock);
        $checkSize = checkInt($invSize);
        $checkWeight = checkInt($invWeight);

        /*         * **************************************************************************** */
// Check for missing Product data
        /*         * **************************************************************************** */
        if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($checkPrice) || empty($checkStock) || empty($checkSize) || empty($checkWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add_product.php';
            exit;
        }

//Send the data to the model
        $prodOutcome = newProduct($invName, $invDescription, $invImage, $invThumbnail
                , $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId
                , $invVendor, $invStyle);

// Check and report the result
        if ($prodOutcome === 1) {
            $message = "<p>Added.</p>";
            include '../view/add_product.php';
            exit;
        } else {
            $message = "<p>it didn't work!!!!</p>";
            include '../view/add_prodcut.php';
            exit;
        }

        break;

    case 'mod';
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-update.php';
        exit;
        break;

    case 'updateProd':
        $catType = filter_input(INPUT_POST, 'catType', FILTER_SANITIZE_NUMBER_INT);
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImg = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumb = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        if (empty($catType) || empty($invName) || empty($invDescription) || empty($invImg) || empty($invThumb) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
            $message = '<p>Please complete all information for the updated item! Double check the category of the item.</p>';
            include '../view/prod-update.php';
            exit;
        } $updateResult = updateProduct($invName, $invDescription, $invImg, $invThumb, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $catType, $invVendor, $invStyle, $invId);
        if ($updateResult) {
            $message = "<p class='notify'>Congratulations, $invName was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p>Error. The $invName was not updated.</p>";
            include '../view/prod-update.php';
            exit;
        }
        break;

    case'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-delete.php';
        exit;
        break;

    case 'deleteProd':
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteProduct($invId);
        if ($deleteResult) {
            $message = "<p class='notify'>Congratulations, $invName was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p>Error. The $invName was not deleted.</p>";
            include '../view/prod-delete.php';
            exit;
        }
        break;

    case 'category':
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($type);
        if (!count($products)) {
            $message = "<p class='notice'>Sorry, no $type products could be found.</p>";
        } else {
            $prodDisplay = buildProductsDisplay($products);
        }
        include '../view/category.php';
        break;

    case 'viewProd':
        $invId = filter_input(INPUT_GET, 'prodNum', FILTER_SANITIZE_NUMBER_INT);
        $products = getProductInfo($invId);
        $_SESSION['prodData'] = $products;
        $thumb = getThumb($invId);
        if (empty($products)) {
            $prodView = "<p class='notice'>Sorry, that product could not be found.</p>";
        } else {
            $prodView = buildProductsView($products);
            $thumbProdView = buildThumbView($thumb);
            
            if(isset($_SESSION['clientData'])){
            $firstname = $_SESSION['clientData']['clientFirstname'];
            $firstL = substr($firstname,0,1);
            $lastname = $_SESSION['clientData']['clientLastname'];
            }
            $reviewInv = getReviewInv($invId);
             $reviewView = buildReviewView($reviewInv);
        }

        include '../view/product-detail.php';
        break;

    default :
        $products = getProductBasics();
            if (count($products) > 0) {
                $prodList = buildManageProductListView($products);
        } else {
            $message = '<p class="notify">Sorry, no products were returned.</p>';
        }

        include '../view/product.php';
        break;
}