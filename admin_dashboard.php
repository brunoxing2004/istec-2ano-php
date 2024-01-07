<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Implementação básica para listar todos os tickets
$stmt = $conn->prepare("SELECT id, title, status FROM tickets");
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Administrador</title>
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
    <h2>Dashboard do Administrador - Bem-vindo, <?php echo $_SESSION["username"]; ?>!</h2>

    <?php foreach ($tickets as $ticket): ?>
        <div class="ticket">
            <h3><?php echo $ticket["title"]; ?></h3>
            <p>Status: <?php echo $ticket["status"]; ?></p>
            <!-- Adicionar botões e lógica para fechar/responder ao ticket aqui -->
            <form class="update-form" method="post" action="process_update.php">
                <input type="hidden" name="ticket_id" value="<?php echo $ticket["id"]; ?>">
                <textarea name="update_text" placeholder="Adicionar resposta" rows="3" required></textarea><br>
                <input type="submit" value="Enviar Resposta">
            </form>
        </div>
    <?php endforeach; ?>

    <a href="logout.php">Logout</a>
</body>
</html>
