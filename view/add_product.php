<?php
if ((!isset($_SESSION['loggedin'])) || ($_SESSION['clientData']['clientLevel'] < 2)) {
    header('Location: /acme/index.php');
}

// Build a dropdown list that uses the $categoryies array
$catList = '<Select id="categoryId"  name="categoryId">';
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'";
if(isset($catType)){
    
    if($category['categoryId'] === $catType){
    $catList .= ' selected ';
 }
}   
    $catList .= ">$category[categoryName]</option>";
}
$catList .= "</select>";

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
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
            <h1>Add Product</h1>
        </header>
        <main>
            <div class="center">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            </div>
            <form method="post" action="/acme/products/index.php">
                <div class="center">
                <p>Add a new product below. All fields are required!</p>
                </div>
                <div class="formClass">

                    <label><b>Category</b></label>
                    <?php echo $catList; ?>

                    <label><b>Name</b></label>
                    <input type="text" name="invName" id="invName"
                           <?php if (isset($invName)) {
                               echo "value='$invName'";
                           } ?> required>

                    <label><b>Description</b></label>
                    <input type="text" name="invDescription" id="invDescription"
                            <?php if (isset($invDescription)) {
                                echo "value='$invDescription'";
                            } ?>required>

                    <label><b>Image</b></label>
                    <input type="text" name="invImage" id="invImage"
                           <?php if (isset($invImage)) {
                               echo "value='$invImage'";
                           } ?> required>

                    <label><b>Thumbnail</b></label>
                    <input type="text" name="invThumbnail" id="invThumbnail"
                            <?php if (isset($invThumbnail)) {
                                echo "value='$invThumbnail'";
                            } ?> required>

                    <label><b>Price</b></label>
                    <input type="text" name="invPrice" id="invPrice"
                           <?php if (isset($invPrice)) {
                               echo "value='$invPrice'";
                           } ?> pattern="\d+(\.\d{2})?" required>

                    <label><b>Stock</b></label>
                    <input type="text" name="invStock" id="invStock"
                            <?php if (isset($invStock)) {
                                echo "value='$invStock'";
                            } ?> pattern="\d+" required>

                    <label><b>Size</b></label>
                    <input type="text" name="invSize" id="invSize"
                           <?php if (isset($invSize)) {
                               echo "value='$invSize'";
                           } ?> pattern="\d+" required>

                    <label><b>Weight</b></label>
                    <input type="text" name="invWeight" id="invWeight"
                            <?php if (isset($invWeight)) {
                                echo "value='$invWeight'";
                            } ?> pattern="\d+" required>

                    <label><b>Location</b></label>
                    <input type="text" name="invLocation" id="invLocation"
                            <?php if (isset($invLocation)) {
                                echo "value='$invLocation'";
                            } ?> required>

                    <label><b>Vendor</b></label>
                    <input type="text" name="invVendor" id="invVendor"
                            <?php if (isset($invVendor)) {
                                echo "value='$invVendor'";
                            } ?> required>

                    <label><b>Style</b></label>
                    <input type="text" name="invStyle" id="invStyle"
                            <?php if (isset($invStyle)) {
                                echo "value='$invStyle'";
                            } ?> required>

                    <button type="submit" id="regbtn" value="subProd">Add</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="subProd">
                </div>
            </form> 
        </main>
        <footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
