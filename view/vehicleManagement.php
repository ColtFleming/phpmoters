<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PHP Motors Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management | PHP Motors</title>
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
        <h1>Vehicle Management</h1>
        <ul>
            <li><a href="/phpmotors/vehicles?action=add-classification-page">Add Classification</a></li>
            <li><a href="/phpmotors/vehicles?action=add-vehicle-page">Add Vehicle</a></li>
        </ul>
        <?php
            if (isset($message)) { 
                echo $message; 
            } 
            if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2>'; 
                echo '<p>Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
            }
        ?>
        <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>
        <table id="inventoryDisplay"></table>
    </main>
    <hr>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>
</html><?php unset($_SESSION['message']); ?>