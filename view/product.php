<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('Location: /acme/index.php');
}
 if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?>
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
            <h1>Product Management</h1>
        </header>
        <main>
            <div class="center">
                <p>Welcome to the product management page. Please chose an option below:</p>
                <ul>
                    <li><a href="/acme/products/index.php/?action=newCat">Add a New Category</a></li>
                    <li><a href="/acme/products/index.php/?action=newProd">Add a New Product</a></li>
                </ul>

                <?php
                if (isset($message)) {
                    echo $message;
                } if (isset($prodList)) {
                    echo $prodList;
                }
                ?>

            </div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
<?php unset($_SESSION['message']); ?> 