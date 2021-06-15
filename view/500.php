<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PHP Motors Server Error page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/home.css" media="screen">
</head>
<body>
    <div id="wrapper">
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
    </header>
    <nav>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php';?>
    </nav>
    <main>
        <h1 id="errorTitle">Server Error</h1>
        <p id="errorMessage">Sorry our server seems to be experiencing some technical difficulties. Please check back later.</p>
    </main>
    <hr>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
</body>
</html>