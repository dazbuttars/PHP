<?php
if ((!isset($_SESSION['loggedin'])) || ($_SESSION['clientData']['clientLevel'] < 2)) {
    header('Location: /acme/index.php');
}
?>
<!DOCTYPE html>

<html>
    <head>
        <title>ACME | Registration</title>
        <meta charset="UTF-8">
        <link href="/acme/css/acme.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
            <nav>
                <?php echo $navList; ?> 
            </nav>
            <h1>New Category</h1>
        </header>
        <main>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post" action="/acme/products/index.php">

                <div class="formClass">

                    <input type="text" name="categoryName" id="categoryName"
                           <?php if (isset($categoryName)) {
                               echo "value='$categoryName'";
                           } ?>required>

                    <button type="submit" id="catbtn" value="subCat">Add Category</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="subCat">
                </div>
            </form> 
        </main>
        <footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
