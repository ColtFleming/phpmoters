<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PHP Motors Sign-in">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | PHP Motors</title>
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
        <h1>Sign in</h1>
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
               }
            if(isset($message)){
                echo $message;
            }
        ?>
        <form action="/phpmotors/accounts/" method="post">
            <label for="email" class="inline">Email: </label>
            <input type="email" id="email" name="clientEmail" required placeholder="smi21003@byui.edu" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> >
            <label for="password" class="inline">Password: </label>
            <span id="passDes">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <input type="password" id="password" name="clientPassword" pattern="(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,}" required>
            <input class="btm" type="submit" value="Sign-in">
            <input type="hidden" name="action" value="Login">    
        </form>
        <a href="/phpmotors/accounts?action=register-page" id="memLink" title="Register with PHP Motors">Not a member yet?</a>
    </main>
    <hr>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
</body>
</html>