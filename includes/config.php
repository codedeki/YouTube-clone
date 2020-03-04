<?php 
ob_start(); // turns on output buffering

date_default_timezone_set("America/Toronto");

try {
    $con = new PDO("mysql:dbname=VideoTube;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} 
catch(PDOException $e) { //our variable $e is type PDOException
    echo "Connection failed: " . $e->getMessage();
}

?>