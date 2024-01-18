<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticket_id = $_POST["ticket_id"];
    $update_text = $_POST["update_text"];

    // Verificar se o usuário tem permissão para atualizar este ticket
    $stmt = $conn->prepare("SELECT user_id, status FROM tickets WHERE id = :ticket_id");
    $stmt->bindParam(':ticket_id', $ticket_id);
    $stmt->execute();
    $ticket = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SESSION["user_id"] == $ticket["user_id"]) {
        // Usuário está autorizado a atualizar o ticket
        $stmt = $conn->prepare("INSERT INTO updates (ticket_id, user_id, update_text) VALUES (:ticket_id, :user_id, :update_text)");
        $stmt->bindParam(':ticket_id', $ticket_id);
        $stmt->bindParam(':user_id', $_SESSION["user_id"]);
        $stmt->bindParam(':update_text', $update_text);
        $stmt->execute();
    } elseif ($_SESSION["admin"]) {
        // Administrador está autorizado a fechar o ticket
        $stmt = $conn->prepare("UPDATE tickets SET status = 'Closed' WHERE id = :ticket_id");
        $stmt->bindParam(':ticket_id', $ticket_id);
        $stmt->execute();

        // Registrar a resposta do administrador
        $stmt = $conn->prepare("INSERT INTO updates (ticket_id, admin_id, update_text) VALUES (:ticket_id, :admin_id, :update_text)");
        $stmt->bindParam(':ticket_id', $ticket_id);
        $stmt->bindParam(':admin_id', $_SESSION["user_id"]);
        $stmt->bindParam(':update_text', $update_text);
        $stmt->execute();
