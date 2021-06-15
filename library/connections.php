<?php
/*
 * Proxy connection to the phpmotors database
 */

function phpmotorsConnect(){
    $server = 'localhost';
    $dbname= 'phpmotors';
    $username = 'iClient';
    $password = 'crrZ3sBralW()M3G';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try{
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
        //if(is_object($link)){
        //    echo 'It worked!';
        //}
    } catch(PDOException $e) {
        header('Location: /phpmotors/view/500.php');
        exit;
        //echo "It didn't work, error: ". $e->getMessage();
    }

}
?>