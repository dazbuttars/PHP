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
            <h1>Modify <?php echo $invName; ?> Review</h1>
        </header>
        <main>
            <form method="post" action="/acme/reviews/index.php">
                <label><b>Review Text</b></label>
                <textarea name="reviewText" id="reviewText" required>
                <?php
               if (isset($reviewInfo['reviewText'])) {
                    echo $reviewInfo['reviewText'];
                }
                ?></textarea>
                <button type="submit" id="regbtn" value="Update Review">Update</button>

                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updateReview">
                <input type="hidden" name="reviewId" value="<?php if (isset($reviewInfo['reviewId'])) {
                           echo $reviewInfo['reviewId'];} elseif(isset($reviewId)){ echo $reviewId;
                       }
                ?>"> 
            </form>
        </main>
        <footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
