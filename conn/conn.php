<?php

$servername = "localhost";
$username = "u885503629_zulfadly";
$password = "@Kidssuper6";
$db = "u885503629_take_note_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    echo "Failed " . $e->getMessage();
}

?>