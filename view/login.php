<!DOCTYPE html>

<html>
    <head>
        <title>ACME | Login</title>
        <meta charset="UTF-8">
        <link href="/acme/css/acme.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
            <nav>
                <?php echo $navList; ?> 
            </nav>
            <h1>Login</h1>
        </header>
        <main>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post" action="/acme/accounts/index.php">

                <div class="formClass">
                    <label><b>Email Address</b></label>
                    <input type="email" placeholder="Email" id="clientEmail" name="clientEmail" required>

                    <label><b>Password</b></label>
                    <input type="password" placeholder="Password" id="clientPassword" name="clientPassword"  pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?!.[\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                   
                    <button  type="submit" value="login">Login</button>
                    <input type="hidden" name="action" value="Login">


                </div>
            </form>


            <form method="post">
                <div class="formClass">
                    <label><b>Not a member?</b></label>
                    <button type="submit" name="action" value="registration" >Create an Account</button>
                </div>
            </form>

        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
