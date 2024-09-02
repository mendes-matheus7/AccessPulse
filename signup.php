<?php
include('connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $cpf = $_POST["cpf"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];
    $telefone = $_POST["telefone"];
    $datanascimento = $_POST["datanascimento"];
    $senha = $_POST["senha"]; // Armazena a senha de forma segura

    // Não é necessário hashear novamente a senha confirmada
    $senhaConfirmada = $_POST["confirmarsenha"];

    if ($senha !== $senhaConfirmada) {
        echo "Erro: As senhas não coincidem.";
        exit();
    }

    // Insere os dados no banco de dados
    $sql = "INSERT INTO membro (cpf, nome, email, endereco, telefone, datanascimento, senha) 
            VALUES ('$cpf', '$nome', '$email', '$endereco', '$telefone', '$datanascimento', '$senha')";

    if ($mysqli->query($sql) === TRUE) {
        echo "<script>alert('Cadastro realizado com sucesso!');</script>";
        header("Location: signinclient.php");
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles/cadastro.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
  <title>Home</title>
  <script src="signup.js"></script>
</head>
<body>
    <div class="cadastro-container">
        <div class="logo-container">
            <img src="img/logo_pink.png" alt="logo" style="max-width: 100%;">
        </div>

        <h2>Cadastro</h2>
        <form action="#" method="post" id="cadastroForm">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpfFormatado" oninput="formatarCPF(this)" maxlength="14" required>
            <input type="hidden" id="cpf" name="cpf">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" required>

            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" pattern="[0-9]{10,11}" placeholder="Apenas números, mínimo 10 dígitos" required>

            <label for="datanascimento">Data de Nascimento:</label>
            <input type="date" id="datanascimento" name="datanascimento" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="confirmarsenha">Confirmar Senha:</label>
            <input type="password" id="confirmarsenha" name="confirmarsenha" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>