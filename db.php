<?php
$servername = "127.0.0.1";
$username = "helpdesk_istec";
$password = "helpdesk_istec";
$dbname = "helpdesk_istec";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}
?>
