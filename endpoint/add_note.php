<?php
include('../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteTitle = $_POST["note_title"];
    $dateTime = date("Y-m-d H:i:s");

    try {
        $stmt = $conn->prepare("INSERT INTO tbl_notes (note_title, date_time) VALUES (:note_title, :date_time)");
        $stmt->bindParam(':note_title', $noteTitle);
        $stmt->bindParam(':date_time', $dateTime);
        $stmt->execute();
        echo "Note added successfully!";
        header("location: https://mzverse.my.id");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        header("location: https://mzverse.my.id");
    }
}
