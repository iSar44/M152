<?php
$serverName = "localhost";
$db = "dbtest";
$port = "3306";
$username = "root";
$password = "admin";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$db;port=$port", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*echo "----Connexion BDD----";
    echo nl2br("<br/>");
    echo "<b><i>Connected successfully</i></b>";
    echo nl2br("<br/>");
    echo "----------------------------";*/
	$image = $conn->query('SELECT * FROM `media` WHERE typeMedia = "image";');

    $imageChap4 = $conn->query('SELECT * FROM `media` ORDER BY creationDate DESC;');

	$insertImage = $conn->prepare('INSERT INTO `media` (`typeMedia`, `nomMedia`, `creationDate`) VALUES (?, ?, ?);');

	$deleteImage = $conn->prepare('DELETE FROM `media` WHERE idMedia = ? AND typeMedia = "image";');

	$modifImage = $conn->prepare('UPDATE `media` SET `nomMedia` = ?, modificationDate = ? WHERE `idMedia` = ? AND typeMedia = "image";');

    }
 catch(PDOException $e)
    {
    echo "----Connexion BDD----";
    echo nl2br("<br/>");
    echo "Connection failed: " . $e->getMessage();
    echo nl2br("<br/>");
    echo "----------------------------";
    }

    //mysqli_connect()
?>