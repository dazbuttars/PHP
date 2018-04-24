<img class="acmeLogo" src="/acme/images/site/logo.gif" alt="ACME company logo">
<figure class="loginIconFig">
    <?php if(isset($cookieFirstname)){
  echo "<span>Welcome $cookieFirstname</span>";
  echo '<img class="loginIcon" src="/acme/images/site/account.gif" alt="login acount icon">';
} ?>
    
    <figcaption class="myAccount"><?php
            if (isset($_SESSION['loggedin'])) {
                $clientFirstname = $_SESSION['clientData']['clientFirstname'];
                  echo "<span><a href='/acme/accounts/index.php/?action=admin'>Welcome $clientFirstname</a></span>";
                  echo '<img class="loginIcon" src="/acme/images/site/account.gif" alt="login acount icon">';
                echo "<span><a href='/acme/accounts/index.php/?action=Logout'> Logout</a></span>";
            } else {
                 echo '<img class="loginIcon" src="/acme/images/site/account.gif" alt="login acount icon">';
                echo "<span><a href='/acme/accounts/index.php/?action=login'> My Account</a></span>";
            }
            ?></figcaption>
</figure>

<!--      <div class="nav">
          <a href="home.php">Home</a>
          <a href="#Cannon">Cannon</a>
          <a href="#Explosive">Explosive</a>
          <a href="#Misc">Misc</a>
          <a href="#Rocket">Rocket</a>
          <a href="#Trap">Trap</a>
      </div>
-->

