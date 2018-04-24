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
            <h1>Create Account</h1>
        </header>
        <main>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post" action="/acme/accounts/index.php">

                <div class="formClass">

                    <label><b>First Name</b></label>
                    <input type="text" placeholder="First Name" name="clientFirstname" 
                    <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>

                    <label><b>Last Name</b></label>
                    <input type="text" placeholder="Last Name" name="clientLastname" 
                    <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>

                    <label><b>Email Address</b></label>
                    <input type="email" placeholder="Email" name="clientEmail" 
                    <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>

                    <label><b>Password</b></label>
                    <p class ="smallP">The password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</p>
                    <input type="password" placeholder="Password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>

                    <button type="submit" id="regbtn" >Register</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="register">
                </div>
            </form> 
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
