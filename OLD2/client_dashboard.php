<?php
include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="css/style_client.css">
    <style>

    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/script_client.js"></script>
</head>

<body>

    <div class="header">
        <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <form class="button-form" method="post" action="logout.php">
            <input type="submit" value="Logout">
        </form>
    </div>

    <div class="dashboard-container">
        <h2>Criar Novo Ticket</h2>
        <form class="ticket-form" method='post' action='client_dashboard.php'>
            <div class="form-group">
                <label for='title'>Título:</label>
                <input type='text' id='title' name='title' required>
            </div>
            <div class="form-group">
                <label for='description'>Descrição:</label>
                <textarea id='description' name='description' required></textarea>
            </div>
            <div class="form-group">
                <input type='submit' value='Criar Ticket'>
            </div>
        </form>

        <?php
        try {
            $db = getDatabaseConnection();

            if (!$db) {
                die("Erro na conexão com o banco de dados.");
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $title = $_POST['title'];
                $description = $_POST['description'];
            
                if (empty($title)) {
                    echo "<p>O campo 'Título' é obrigatório.</p>";
                } else {
                    try {
                        $db->beginTransaction();
            
                        // Use the user's session 'id' when inserting the ticket
                        $insertQuery = $db->prepare("INSERT INTO tickets (user_id, title, description, status) VALUES (:user_id, :title, :description, :status)");
                        $insertQuery->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
                        $insertQuery->bindParam(':title', $title);
                        $insertQuery->bindParam(':description', $description);
                        $status = "Em Processo "; 
                        $insertQuery->bindParam(':status', $status);
            
                        // Debugging: Print the SQL query
                        var_dump($insertQuery);
            
                        $insertQuery->execute();
            
                        $db->commit();
            
                        echo "<p>Ticket criado com sucesso!</p>";
            
                        header("Location: client_dashboard.php");
                        exit();
                    } catch (PDOException $e) {
                        $db->rollBack();
                        echo "Erro ao inserir o ticket: " . $e->getMessage();
                    }
                }
            }
            echo "<h2>Tickets Antigos</h2>";


            $query = $db->prepare("SELECT id, title, description, status, response FROM tickets WHERE id");
            $query->execute();

            $tickets = $query->fetchAll(PDO::FETCH_ASSOC);

            if (count($tickets) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "    <th>Título</th>";
                echo "    <th>Descrição</th>";
                echo "    <th>Status</th>";
                echo "    <th>Ações</th>";
                echo "</tr>";

                foreach ($tickets as $ticket) {
                    echo "<tr>";
                    echo "    <td>{$ticket['title']}</td>";
                    echo "    <td>{$ticket['description']}</td>";
                    echo "    <td>{$ticket['status']}</td>";
                    echo "    <td>";
                    echo "        <button class='action-button view-details' data-title='{$ticket['title']}' data-description='{$ticket['description']}' data-status='{$ticket['status']}' data-response='{$ticket['response']}'>Ver Detalhes</button>";
                    echo "    </td>";
                    echo "</tr>";
                }

                echo "</table>";

                echo "<div class='details-section' id='details-container'>";
                echo "    <h2>Detalhes do Ticket</h2>";
                echo "    <p id='responseText'></p>";
                echo "</div>";
            } else {
                echo "<p>Você ainda não criou nenhum ticket.</p>";
            }

            include 'includes/footer.php';
        } catch (PDOException $e) {
            if (isset($db)) {
                $db->rollBack();
            }
            die("Erro: " . $e->getMessage());
        }
        ?>

    </div>

</body>

</html>
