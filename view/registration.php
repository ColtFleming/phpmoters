<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PHP Motors Sign up">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up | PHP Motors</title>
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
        <h1>Register</h1>
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
            <label for="password" class="inline">Password: </label>            
            <span id="passDes">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <input type="password" id="password" name="clientPassword" required pattern="(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,}" title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character">
            <input class="btm" type="submit" name="submit" value="Register">
            <input type="hidden" name="action" value="register">     
        </form>
    </main>
    <hr>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
</body>
</html>