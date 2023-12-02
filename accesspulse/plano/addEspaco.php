<?php
include('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $capacidade = $_POST["capacidade"];
    $horarioabertura = $_POST["horarioabertura"];
    $horariofechamento = $_POST["horariofechamento"];

    // Insere os dados no banco de dados
    $sql = "INSERT INTO espaco (nomeespaco, capacidade, horarioabertura, horariofechamento) 
            VALUES ('$nome', $capacidade, '$horarioabertura', '$horariofechamento')";

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
  <title>Add Espaço</title>
</head>
<body>
    <div class="cadastro-container">
        <div class="logo-container">
            <img src="../img/logo_pink.png" alt="logo" style="max-width: 100%;">
        </div>

        <h2>Novo Espaço</h2>
        <form action="#" method="post" id="ModalidadeForm">
            <label for="nome">Nome do local:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="capacidade">Capacidade:</label>
            <input type="number" id="capacidade" name="capacidade" required>
            
            <label for="horarioabertura">Horário de Abertura</label>
            <input type="time" id="horarioabertura" name="horarioabertura" required>

            <label for="horariofechamento">Horário de Fechamento</label>
            <input type="time" id="horariofechamento" name="horariofechamento" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
