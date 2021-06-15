<?php
//Build the select list
$classifList = '<select name="classificationId" id="classificationName" required>';
$classifList .= "<option value='' selected disabled>Select Car Classification</option>"; 
foreach ($classifications as $classification){
    $classifList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId){
            $classifList .= ' selected ';
        }
    }
    
    $classifList .= ">$classification[classificationName]</option>";
}
$classifList .= '</select>';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PHP Motors New Vehicle">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Vehicle | PHP Motors</title>
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
        <h1>Add a Vehicle</h1>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
        <p class="note">*Note all fields are required</p>
        <form action="/phpmotors/vehicles/index.php" method="post">
            <label for="classificationName">Classification:</label>
            <?php echo $classifList; ?>
            <label for="invMake" class="inline">Make: </label>
            <input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";}  ?> required>
            <label for="invModel" class="inline">Model: </label>
            <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";}  ?> required>
            <label for="invPrice" class="inline">Price: </label>
            <input type="number" id="invPrice" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required title="Must be a whole number">
            <label for="invStock" class="inline">Number(s) In Stock: </label>
            <input type="number" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> required title="Must be a whole number">
            <label for="invColor" class="inline">Color: </label>
            <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";}  ?> required>
            <label for="invImage" class="inline">Image Path: </label>
            <input type="text" id="invImage" name="invImage" <?php if(isset($invImage)){echo "value='$invImage'";}  ?> required placeholder="/phpmotors/images/no-image.png" pattern="(/phpmotors/images/).{1,32}" title="Must begin with /phpmotors/images/">
            <label for="invThumbnail" class="inline">Thumbnail Path: </label>
            <input type="text" id="invThumbnail" name="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> required placeholder="/phpmotors/images/no-image.png" pattern="(/phpmotors/images/).{1,32}" title="Must begin with /phpmotors/images/">
            <label for="invDescription" class="inline">Description: </label>                
            <textarea id="invDescription" name="invDescription" rows="4" cols="40" required><?php if(isset($invDescription)){echo "$invDescription";}?></textarea>
            <input class="btm" type="submit" name="submit" value="Add Vehicle">
            <input type="hidden" name="action" value="add-vehicle">     
        </form>
    </main>
    <hr>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
</body>
</html>