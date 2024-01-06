<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sum Calculator</title>
</head>
<body>

<?php
// Verifica se num1 e num2 estão definidos na URL
if (isset($_GET['num1']) && isset($_GET['num2'])) {
    // Obtém os valores de num1 e num2 da URL
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];

    // Verifica se os valores são numéricos
    if (is_numeric($num1) && is_numeric($num2)) {
        // Calcula a soma
        $sum = $num1 + $num2;

        // Exibe o resultado em HTML
        echo "<p>A soma de $num1 e $num2 é: $sum</p>";
    } else {
        // Exibe uma mensagem de erro se os valores não forem numéricos
        echo "<p>Por favor, forneça valores numéricos para num1 e num2.</p>";
    }

    // Adiciona um link de volta ao formulário
    echo '<p><a href="form2.html">Voltar ao Formulário</a></p>';
} else {
    // Exibe uma mensagem de erro se num1 ou num2 não estiverem definidos na URL
    echo "<p>Por favor, forneça valores para ambos num1 e num2.</p>";
}
?>

</body>
</html>
