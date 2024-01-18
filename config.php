<?php
function getDatabaseConnection() {
    $db_path = '/home/carmezim/projeto/helpdesk.db'; // Verifique o caminho correto

    try {
        $db = new PDO("sqlite:$db_path");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Erro na ligação à base de dados: " . $e->getMessage());
    }
}
?>
