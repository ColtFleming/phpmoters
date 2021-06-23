<?php
    if($_SESSION['loggedin']){
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $clientLastname = $_SESSION['clientData']['clientLastname'];
        $clientEmail = $_SESSION['clientData']['clientEmail'];
        $clientLevel = $_SESSION['clientData']['clientLevel'];
    }else{
        header('Location: /phpmotors/');
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PHP Motors Admin Page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Admin | PHP Motors</title>
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
    <?php
        //user info
        echo "<h1>$clientFirstname $clientLastname</h1>";
        echo "<p class='general'>You are logged in.</p>";
        if (isset($_SESSION['message'])) { 
            echo $_SESSION['message']; 
        } 
        echo "<ul><li>First name: $clientFirstname</li><li>Last name: $clientLastname</li><li>Email: $clientEmail</li></ul>";

        //update account link
        echo '<h2 class="general">Account Management</h2>';
        echo '<p class="general">Use this link to update account information.</p>';
        echo '<a href="/phpmotors/accounts?action=updateAccView" id="memLink" title="Update account information with PHP Motors">Update Account Information</a>';
        
        //Display Vehicle management if login as Admin
        if($clientLevel > 1){
            echo '<h2 class="general">Inventory Management</h2>';
            echo '<p class="general">Use this link to manage the inventory.</p>';
            echo '<a href="/phpmotors/vehicles?action=" id="memLink" title="Vehicles Management with PHP Motors">Vehicle Management</a>';
        }
    ?>
        
    </main>
    <hr>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']); ?>