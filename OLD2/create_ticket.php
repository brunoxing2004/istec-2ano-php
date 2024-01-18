<?php
include 'config.php';

session_start();
$db = new SQLite3('helpdesk.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Seu código para criar tickets aqui...
}
?>

<!-- Formulário para criar um ticket -->
<?php include 'includes/header.php'; ?>
<form method="post" action="create_ticket.php">
    <!-- Campos do ticket aqui... -->
    <input type="submit" value="Criar Ticket">
</form>
<?php include 'includes/footer.php'; ?>
