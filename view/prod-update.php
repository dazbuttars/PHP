<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('Location: /acme/index.php');
}

// Build the categories option list
$catList = '<select name="catType" id="catType">';
$catList .= "<option>Choose a Category</option>";
foreach ($categories as $category) {
 $catList .= "<option value='$category[categoryId]'";
  if(isset($catType)){
   if($category['categoryId'] === $catType){
   $catList .= ' selected ';
  }
 } elseif(isset($prodInfo['categoryId'])){
  if($category['categoryId'] === $prodInfo['categoryId']){
   $catList .= ' selected ';
  }
}
$catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';
?>
<!DOCTYPE html>

<html>
    <head>
        <title>
            <?php if(isset($prodInfo['invName'])){ echo "Modify "
            . "$prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?> | Acme, Inc
        </title>
        <meta charset="UTF-8">
        <link href="/acme/css/acme.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
            <nav>
                <?php echo $navList; ?> 
            </nav>
            <h1>
                <?php if(isset($prodInfo['invName'])){ echo "Modify "
                    . "$prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?>
            </h1>
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
                <p>All fields are required!</p>
                </div>
                <div class="formClass">

                    <label><b>Category</b></label>
                    <?php echo $catList; ?>

                    <label><b>Name</b></label>
                     <input type="text" name="invName" id="invName" required 
                         <?php if(isset($invName)){ echo "value='$invName'"; }
                         elseif(isset($prodInfo['invName'])) 
                             {echo "value='$prodInfo[invName]'"; }?>> 

                    <label><b>Description</b></label>
                     <input type="text" name="invDescription" id="invDescription" required 
                         <?php if(isset($invDescription)){ echo "value='$invDescription'"; }
                         elseif(isset($prodInfo['invDescription'])) 
                             {echo "value='$prodInfo[invDescription]'"; }?>> 

                    <label><b>Image</b></label>
                     <input type="text" name="invImage" id="invImage" required 
                         <?php if(isset($invImage)){ echo "value='$invImage'"; }
                         elseif(isset($prodInfo['invImage'])) 
                             {echo "value='$prodInfo[invImage]'"; }?>> 

                    <label><b>Thumbnail</b></label>
                     <input type="text" name="invThumbnail" id="invThumbnail" required 
                         <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; }
                         elseif(isset($prodInfo['invThumbnail'])) 
                             {echo "value='$prodInfo[invThumbnail]'"; }?>> 

                    <label><b>Price</b></label>
                     <input type="text" name="invPrice" id="invPrice" required 
                         <?php if(isset($invPrice)){ echo "value='$invPrice'"; }
                         elseif(isset($prodInfo['invPrice'])) 
                             {echo "value='$prodInfo[invPrice]'"; }?>> 

                    <label><b>Stock</b></label>
                     <input type="text" name="invStock" id="invStock" required 
                         <?php if(isset($invStock)){ echo "value='$invStock'"; }
                         elseif(isset($prodInfo['invStock'])) 
                             {echo "value='$prodInfo[invStock]'"; }?>> 

                    <label><b>Size</b></label>
                     <input type="text" name="invSize" id="invSize" required 
                         <?php if(isset($invSize)){ echo "value='$invSize'"; }
                         elseif(isset($prodInfo['invSize'])) 
                             {echo "value='$prodInfo[invSize]'"; }?>> 

                    <label><b>Weight</b></label>
                     <input type="text" name="invWeight" id="invWeight" required 
                         <?php if(isset($invWeight)){ echo "value='$invWeight'"; }
                         elseif(isset($prodInfo['invWeight'])) 
                             {echo "value='$prodInfo[invWeight]'"; }?>> 

                    <label><b>Location</b></label>
                     <input type="text" name="invLocation" id="invLocation" required 
                         <?php if(isset($invLocation)){ echo "value='$invLocation'"; }
                         elseif(isset($prodInfo['invLocation'])) 
                             {echo "value='$prodInfo[invLocation]'"; }?>> 

                    <label><b>Vendor</b></label>
                     <input type="text" name="invVendor" id="invVendor" required 
                         <?php if(isset($invVendor)){ echo "value='$invVendor'"; }
                         elseif(isset($prodInfo['invVendor'])) 
                             {echo "value='$prodInfo[invVendor]'"; }?>> 

                    <label><b>Style</b></label>
                     <input type="text" name="invStyle" id="invStyle" required 
                         <?php if(isset($invStyle)){ echo "value='$invStyle'"; }
                         elseif(isset($prodInfo['invStyle'])) 
                             {echo "value='$prodInfo[invStyle]'"; }?>> 

                    <button type="submit" id="regbtn" value="Update Prod">Update</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateProd">
                     <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){
                         echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>"> 
                </div>
            </form> 
        </main>
        <footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
