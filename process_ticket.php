<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];

    $stmt = $conn->prepare("INSERT INTO tickets (user_id, title, description, status) VALUES (:user_id, :title, :description, 'Open')");
    $stmt->bindParam(':user_id', $_SESSION["user_id"]);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    header("Location: user_dashboard.php");
    exit();
}
?>
