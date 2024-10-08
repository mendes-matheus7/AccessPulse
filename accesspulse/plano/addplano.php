<?php
include('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $duracao = $_POST["duracao"];
    $valorplano = $_POST["valorplano"];

    // Insere os dados no banco de dados
    $sql = "INSERT INTO plano (nomeplano, duracao, valorplano) 
            VALUES ('$nome', '$duracao', $valorplano)";

    if ($mysqli->query($sql) === TRUE) {
        session_start();
        $_SESSION['mensagem_sucesso'] = 'Cadastro realizado sucesso!';
        header("Location: plano.php");
        exit();        
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($mysqli);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="cadastroplano.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
  <title>Add Plano</title>
</head>
<body>
    <div class="cadastro-container">
        <div class="logo-container">
            <img src="../img/logo_pink.png" alt="logo" style="max-width: 100%;">
        </div>

        <h2>Novo Plano</h2>
        <form action="#" method="post" id="cadastroForm">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="duracao">Duração:</label>
            <input type="text" id="duracao" name="duracao" required>

            <label for="valorplano">Valor do plano:</label>
            <input type="number" id="valorplano" name="valorplano" required>

            <button type="submit"onclick="debugForm()">Cadastrar</button>
            
<script>
function debugForm() {
    var checkboxes = document.querySelectorAll('input[name="modalidades[]"]:checked');
    var values = Array.from(checkboxes).map(function (checkbox) {
        return checkbox.value;
    });
    console.log("Valores dos checkboxes:", values);
}
</script>
        </form>
    </div>
</body>
</html>
