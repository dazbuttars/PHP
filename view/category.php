<!DOCTYPE html>

<html>
    <head>
        <title><?php echo $type; ?> Products | Acme, Inc.</title> 
        <meta charset="UTF-8">
        <link href="/acme/css/acme.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
            <nav>
                <?php echo $navList; ?> 
            </nav>
            <h1><?php echo $type; ?> Products</h1>
        </header>
        <main>
            <?php if (isset($message)) {
                echo $message;
            } ?>
            <?php if (isset($prodDisplay)) {
                echo $prodDisplay;
            } ?> 
        </main>
        <footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
