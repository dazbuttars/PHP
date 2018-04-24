<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('Location: /acme/index.php');
    exit;
}
?>
<!DOCTYPE html>

<html>
    <head>
        <title>
            <?php if(isset($prodInfo['invName'])){ echo "Delete "
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
                <?php if(isset($prodInfo['invName'])){ echo "Delete "
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
                </div>
                <div class="formClass">

                    <label><b>Name</b></label>
                    <input type="text" name="invName" id="invName" readonly
                         <?php if(isset($prodInfo['invName'])) 
                             {echo "value='$prodInfo[invName]'"; }?>> 

                    <label><b>Description</b></label>
                     <input type="text" name="invDescription" id="invDescription" readonly 
                         <?php if(isset($prodInfo['invDescription'])) 
                             {echo "value='$prodInfo[invDescription]'"; }?>>

                    <button type="submit" id="regbtn" value="Delete Prod">Delete</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="deleteProd">
                     <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){
                         echo $prodInfo['invId'];} ?>"> 
                </div>
            </form> 
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>