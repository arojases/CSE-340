<?php 

function phpmotorsConnect()
{
/* Proxy connection to the phpmotors database */

    $server = 'localhost';
    $dbname = 'phpmotors';
    $username = 'iClient';
    $password = 'jSOIy]RCf1vmI)bQ';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        //code...
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
        //return $link;
        /* if (is_object($link)) {
            echo 'It Worked!';
        } */
        

    } catch (PDOException $e) {

        header('Location: /phpmotors/view/500.php');
        exit;
        /* echo "It didn't work, error: ".$e->getMessage(); */
    }
}

//phpmotorsConnect();