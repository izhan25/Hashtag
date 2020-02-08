<?php

// Site URL
$rootUrl = 'http://localhost/hashtag';


// Database Configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hashtag";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    echo "Error: ". $e->getMessage();
}

function url($route) {
    global $rootUrl;
    echo $rootUrl.'/'.$route;
}
