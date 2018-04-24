<?php
if ($_SESSION['clientData']['clientLevel'] < 0) {
    header('Location: /acme/index.php');
    exit;
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
            <h1>Account</h1>
        </header>
        <main>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post" action="/acme/accounts/index.php">

                <div class="formClass">
                    <h2>Account Update</h2>
                    <label><b>First Name</b></label>
                    <input type="text" placeholder="First Name" name="clientFirstname" id="clientFirstname" required
                        <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}
                        elseif(isset ($clientInfo['clientFirstname']))
                             {echo "value='$clientInfo[clientFirstname]'";}?>>

                    <label><b>Last Name</b></label>
                    <input type="text" placeholder="Last Name" name="clientLastname" id="clientLastname" required
                        <?php if(isset($clientLastname)){echo "value='$clientLastname'";}
                        elseif(isset ($clientInfo['clientLastname']))
                             {echo "value='$clientInfo[clientLastname]'";}?>>

                    <label><b>Email Address</b></label>
                    <input type="text" placeholder="Email" name="clientEmail" id="clientEmail" required
                        <?php if(isset($clientEmail)){echo "value='$clientEmail'";}
                        elseif(isset ($clientInfo['clientEmail']))
                             {echo "value='$clientInfo[clientEmail]'";}?>>
                    
                                        <button type="submit" id="infobtn" value="Update Info">Update Info</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateInfo">
                     <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){
                         echo $clientInfo['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>"> 
                </div>
            </form>
            <form method="post" action="/acme/accounts/index.php">
                <div class="formClass">
                     <h2>Password Update</h2>
                    <label><b>Password</b></label>
                    <p class ="smallP">The password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</p>
                    <input type="password" placeholder="Password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>

                    <button type="submit" id="passbtn" value="Update Password">Update Password</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updatePassword">
                     <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){
                         echo $clientInfo['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>"> 
                </div>
            </form> 
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
