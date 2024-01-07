<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Implementação básica para listar tickets do usuário
$user_id = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT id, title, status FROM tickets WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #333;
        }
        .ticket {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 10px;
        }
        .update-form {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Dashboard do Usuário - Bem-vindo, <?php echo $_SESSION["username"]; ?>!</h2>

    <?php foreach ($tickets as $ticket): ?>
        <div class="ticket">
            <h3><?php echo $ticket["title"]; ?></h3>
            <p>Status: <?php echo $ticket["status"]; ?></p>
            <!-- Adicionar botões e lógica para atualizar/cancelar ticket aqui -->
            <form class="update-form" method="post" action="process_update.php">
                <input type="hidden" name="ticket_id" value="<?php echo $ticket["id"]; ?>">
                <textarea name="update_text" placeholder="Adicionar atualização" rows="3" required></textarea><br>
                <input type="submit" value="Enviar Atualização">
                <input type="button" value="Cancelar Ticket" onclick="cancelTicket(<?php echo $ticket["id"]; ?>)">
            </form>
        </div>
    <?php endforeach; ?>

    <h2>Criar Novo Ticket</h2>
    <form method="post" action="process_ticket.php">
        <label for="title">Título:</label>
        <input type="text" name="title" required><br>
        <textarea name="description" placeholder="Descrição do problema" rows="3" required></textarea><br>
        <input type="submit" value="Criar Ticket">
    </form>

    <a href="logout.php">Logout</a>

    <script>
        function cancelTicket(ticketId) {
            if (confirm("Tem certeza de que deseja cancelar este ticket?")) {
                // Implementar lógica AJAX ou formulário para cancelar o ticket
                // Pode ser feito no arquivo process_update.php ou em um arquivo separado
            }
        }
    </script>
</body>
</html>
