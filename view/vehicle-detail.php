<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PHP Motors <?php echo $vehicleInfo['invMake']." ". $vehicleInfo['invModel']; ?> Vehicle">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $vehicleInfo['invMake']." ". $vehicleInfo['invModel']; ?> vehicles | PHP Motors</title>
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
    <h1><?php echo $vehicleInfo['invMake']." ". $vehicleInfo['invModel']; ?></h1>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
        <?php if(isset($vehicleDetail)){
            echo $vehicleDetail;
        } ?>
    </main>
    <hr>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
</body>
</html>