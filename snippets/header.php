<img src=" /phpmotors/images/site/logo.png" alt="php motors">
<!-- <?php if(isset($cookieFirstname)){
        echo "<span>Welcome $cookieFirstname</span>";
    } ?> -->
<!--     <a class="account" href="/phpmotors/accounts/index.php?action=login">My Account</a>-->
<div class='account'>
<?php if(isset($_SESSION['loggedin'])) {
        if ($_SESSION['loggedin'] === TRUE) 
        echo "<span><a href='/phpmotors/accounts/index.php'>", $_SESSION['clientData']['clientFirstname'], "</a></span>";
        echo " | ";
        {echo '<a href="/phpmotors/accounts/index.php/?action=Logout">Logout</a>';}
 } else 
        {echo '<a href="/phpmotors/accounts/index.php/?action=login-page">My Account</a>';
        } ?>
</div>