<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PHP Motors Home Page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | PHP Motors</title>
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
        <h1>Welcome to PHP Motors!</h1>
        <div id="DMC">
            <h2>DMC Delorean</h2>
            <p>3 Cup holders</p>
            <p>Superman doors</p>
            <p>Fuzzy dice</p>
        </div>
        <img src="/phpmotors/images/site/own_today.png" id="own" alt="Own today image button">
        <img src="/phpmotors/images/delorean.jpg" id="delorean" alt="Delorean image">
        <div id="twosides">
            <div id="bottom">
                <h2>Delorean Upgrades</h2>
                <div id="flux">
                    <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor">
                </div>
                <a href="#" id=flux-p>Flux Capacitor</a>
                <div id="flame">
                    <img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decals">
                </div>
                <a href="#" id="flame-p">Flame Decals</a>
                <div id="bumper">
                    <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Sticker">
                </div>
                <a href="#" id="bumper-p">Bumper Stickers</a>
                <div id="hub">
                    <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Caps">
                </div>
                <a href="#" id="hub-p">Hub Caps</a>
            </div>
            <div id="top">
                <h2>DMC Delorean Reviews</h2>
                <ul>
                    <li>"So fast its almost like traveling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly" (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80's livin and I love it!" (5/5)</li>
                </ul>
            </div>
        </div>
    </main>
    <hr>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
</body>
</html>