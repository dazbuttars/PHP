<?php
if ($_SESSION['clientData']['clientLevel'] < 0) {
    header('Location: /acme/index.php');
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
            <h1><?php echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?></h1>
            <p><?php if (isset($message)) {
                    echo $message;
                }; ?></p>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>

        </header>
        <main>
            <div class="center">
                <ul>
                    <li><p>You Are Logged In</p></li>
                    <li>Firstname: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                    <li>Lastname: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                    <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
                    <li><a href="/acme/accounts/index.php/?action=clientUpdate">Update Account Information</a></li>
                </ul>
                <?php
                if ($_SESSION['clientData']['clientLevel'] > 1) {
                    echo '<h2>This link is used for product administration</h2>';
                    echo '<a href="/acme/products/index.php">Products</a>';
                }
                ?>
<?php echo $manageProductReviews; ?>
            </div>



        </main>
        <footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
