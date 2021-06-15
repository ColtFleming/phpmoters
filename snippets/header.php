<img src="/phpmotors/images/site/logo.png" id="logo" alt="PHP Motors Logo">
<?php
    //check if login
    if(isset($_SESSION['loggedin'])){
        echo "<a href='/phpmotors/accounts/' id='cookie'>Welcome ".$_SESSION['clientData']['clientFirstname']."</a>";
        
        echo '<a href="/phpmotors/accounts?action=Logout" title="Logout with PHP Motors" id="acc">Logout</a>';
    }else{
        echo '<a href="/phpmotors/accounts?action=login-page" title="Login or Register with PHP Motors" id="acc">My Account</a>';
    }

    
?>