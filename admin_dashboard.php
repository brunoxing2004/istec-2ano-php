<?php
include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style_admin.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/script_client.js"></script>
</head>

<body>

    <div class="header">
        <h1>Bem-vindo, <?php echo $_SESSION['username']; ?>!</h1>
        <form class="button-form" method="post" action="logout.php">
            <input type="submit" value="Logout">
        </form>
        <form class="button-form" method="get" action="register.php">
            <input type="submit" value="Register">
        </form>
    </div>

    <div class="tickets-container">
        <h2>Tickets</h2>

        <?php
        try {
            $db = getDatabaseConnection();

            if (!$db) {
                die("Erro na conexão com o a BD.");
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['action']) && isset($_POST['ticket_id'])) {
                    $action = $_POST['action'];
                    $ticketId = $_POST['ticket_id'];

                    if ($action === 'responder') {
                        // ... Código para responder a um ticket ...
                    } elseif ($action === 'Alterar Status') {
                        // ... Código para alterar o status de um ticket ...
                    } elseif ($action === 'apagar') {
                        // Excluir o ticket do banco de dados
                        $db->beginTransaction();
                        $deleteQuery = $db->prepare("DELETE FROM tickets WHERE id = :ticket_id");
                        $deleteQuery->bindParam(':ticket_id', $ticketId);
                        $deleteQuery->execute();
                        $db->commit();
                    }
                }
            }

            $query = $db->query("SELECT * FROM tickets");
            $tickets = $query->fetchAll(PDO::FETCH_ASSOC);

            if (count($tickets) > 0) {
                echo "<table class='tickets-table'>";
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
                    echo "        <button class='action-button view-details' data-title='{$ticket['title']}' data-description='{$ticket['description']}' data-status='{$ticket['status']}'>Ver Detalhes</button>";
                    echo "        <button class='action-button respond-button' type='button' onclick='openModal(\"{$ticket['id']}\")'>Responder</button>";
                    echo "        <form class='delete-form' method='post' action='admin_dashboard.php'>";
                    echo "            <input type='hidden' name='ticket_id' value='{$ticket['id']}'>";
                    echo "            <input type='hidden' name='action' value='apagar'>"; // Adicionado campo oculto para ação de apagar
                    echo "            <button class='action-button delete-button' type='submit'>Apagar</button>";
                    echo "        </form>";
                    echo "            Novo Status: <select name='new_status'>";
                    echo "                <option value='Aberto'>Aberto</option>";
                    echo "                <option value='Pendente'>Pendente</option>";
                    echo "                <option value='Fechado'>Fechado</option>";
                    echo "            </select><br>";
                    echo "            <input type='submit' name='action' value='Alterar Status'>";
                    echo "    </td>";
                    echo "</tr>";
                }

                echo "</table>";

                echo "<div class='details-section' id='details-container'>";
                echo "    <h2>Detalhes do Ticket</h2>";
                echo "    <p id='responseText'></p>";
                echo "</div>";

                echo "<div id='myModal' class='modal'>";
                echo "    <div class='modal-content'>";
                echo "        <span class='close' onclick='closeModal()'>&times;</span>";
                echo "        <form class='response-form' method='post' action='admin_dashboard.php'>";
                echo "            <input type='hidden' name='ticket_id' id='modalTicketId'>";
                echo "            Resposta: <textarea name='response'></textarea><br>";

                echo "            </select><br>";
                echo "            <input type='submit' name='action' value='responder'>";
                echo "        </form>";
                echo "    </div>";
                echo "</div>";
            } else {
                echo "<p>Não há tickets disponíveis.</p>";
            }

            include 'includes/footer.php';
        } catch (PDOException $e) {
            if (isset($db)) {
                $db->rollBack();
            }
            die("Erro: " . $e->getMessage());
        }
        ?>

        <script>
            function openModal(ticketId) {
                document.getElementById('modalTicketId').value = ticketId;
                document.getElementById('myModal').style.display = 'block';
            }

            function closeModal() {
                document.getElementById('myModal').style.display = 'none';
            }

            window.onclick = function (event) {
                if (event.target == document.getElementById('myModal')) {
                    closeModal();
                }
            }
        </script>
    </div>

</body>

</html>
