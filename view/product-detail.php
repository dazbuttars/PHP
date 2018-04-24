<!DOCTYPE html>

<html>
    <head>
        <title>ACME</title>
        <meta charset="UTF-8">
        <link href="/acme/css/acme.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
            <nav>
                <?php echo $navList; ?> 
            </nav>
            <h1><?php echo $products['invName'] ?></h1>
        </header>
        <main>
             <div id="droduct-detailDiv">
            <?php echo $thumbProdView; ?>
           
            <?php echo $prodView; ?>
                 </div>
            <?php
            if(isset($_SESSION['clientData'])){
             if($_SESSION['clientData']['clientLevel'] >= 1){
                 
            ?>
               <div class="center">
             <form method="post" action="/acme/reviews/index.php">﻿
            <hr>
            <h2>Customer Reviews</h2>
            <h3>Review the <?php echo $products['invName'] ?></h3>
            <p><b>Screen Name: <?php echo $firstL; echo $lastname; ?></b></p>
            
            <label>Review:</label>
            <textarea name="reviewText" id="reviewText" required></textarea>
            <button type="submit" id="newReview" name="newReview" value="New Review">Submit Review</button>
                   <input type="hidden" name="action" value="newReview">
            
            <input type="hidden" name="invId" value="<?php if(isset($products['invId'])){
            echo $products['invId'];} ?>"> 
            
            <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){
                         echo $_SESSION['clientData']['clientId'];} ?>"> 
             </form>
</div>
            <?php
             }
            }
            ?>
            <?php echo $reviewView;?>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
