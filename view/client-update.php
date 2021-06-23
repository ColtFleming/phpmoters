<?php
    if($_SESSION['loggedin']){
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $clientLastname = $_SESSION['clientData']['clientLastname'];
        $clientEmail = $_SESSION['clientData']['clientEmail'];
        $clientId = $_SESSION['clientData']['clientId'];
    }else{
        header('Location: /phpmotors/');
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PHP Motors Update Account">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/home.css" media="screen">
    
</head>
<body>
    <div id="wrapper">
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
    </header>
    <nav>
    <?php //require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php';
        echo $navList; ?>
    </nav>
    <main>
        <h1>Manage Account</h1>
        <h2>Update Account</h2>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
        <form action="/phpmotors/accounts/index.php" method="post">
            <label for="clientFirstname" class="inline">First name: </label>
            <input type="text" id="clientFirstname" name="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required>
            <label for="clientLastname" class="inline">Last name: </label>
            <input type="text" id="clientLastname" name="clientLastname" <?php if(isset($clientLastname )){echo "value='$clientLastname'";}  ?> required>
            <label for="email" class="inline">Email: </label>                
            <input type="email" id="email" name="clientEmail" placeholder="smi21003@byui.edu" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required> 
            <input class="btm" type="submit" name="submit" value="Update Info">
            <input type="hidden" name="action" value="updateInfo">     
        </form>

        <h2>Update Password</h2>
        <?php
            if (isset($message2)) {
                echo $message2;
            }
        ?>
        <span class="note">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
        <p class="note">*Note your original password will be change.</p>
        <form action="/phpmotors/accounts/index.php" method="post">
            <label for="password" class="inline">Password: </label>            
            <input type="password" id="password" name="clientPassword" required pattern="(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,}" title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character">
            <input class="btm" type="submit" name="submit" value="Update Password">
            <input type="hidden" name="action" value="updatePassword">
        </form>    
    </main>
    <hr>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
</body>
</html>