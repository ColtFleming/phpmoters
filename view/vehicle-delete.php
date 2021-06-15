<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PHP Motors Delete Vehicle">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake'])){ 
	        echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
    <h1><?php if(isset($invInfo['invMake'])){ 
	    echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
        <p class="note">Confirm Vehicle Deletion. The delete is permanent.</p>
        <form action="/phpmotors/vehicles/" method="post">
            <label for="invMake" class="inline">Vehicle Make: </label>
            <input type="text" id="invMake" name="invMake" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?> readonly>
            <label for="invModel" class="inline">Vehicle Model: </label>
            <input type="text" id="invModel" name="invModel" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?> readonly>
            <label for="invDescription" class="inline">Vehicle Description: </label>                
            <textarea id="invDescription" name="invDescription" rows="4" cols="40" readonly><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?></textarea>
            <input class="btm" type="submit" name="submit" value="Delete Vehicle">
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="
            <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];}  ?>">     
        </form>
    </main>
    <hr>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
</body>
</html>