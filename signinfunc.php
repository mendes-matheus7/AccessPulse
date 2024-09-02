<?php
include('connection/connection.php');
if(isset($_POST['cpf']) || isset($_POST['password'])) {

if(strlen($_POST['cpf']) == 0) {
    echo "Informe seu CPF";
} else if(strlen($_POST['password']) == 0) {
    echo "Preencha sua senha";
} else {

    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $password = $mysqli->real_escape_string($_POST['password']);

    $sql_code = "SELECT * FROM funcionario WHERE cpf = '$cpf' AND senha = '$password'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    $quantidade = $sql_query->num_rows;

    if($quantidade == 1) {

        $usuario = $sql_query->fetch_assoc();

        if(!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['user_cpf'] = $usuario['cpf'];
        $_SESSION['user_name'] = $usuario['nome'];
        $_SESSION['user_level'] = "funcionario";
        $_SESSION['user_function'] = $usuario['funcao'];

        header("Location: access/access.php");

    } else {
        $mensagem = "Falha ao logar. Por favor, verifique suas credenciais.";
    }

}
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
  <title>Home</title>
  <script src="login.js"></script>
</head>
<body>
    <div class="grid-container-login">
        <div class="image">
            <img src="img/login.png" alt="login">
        </div>
        <div class="login">
            <div class="logo">
                <img src="img/logo_bg_black.png" alt="logoblack">
            </div>
            <div class="login-container">
                <h2>Login Funcionário</h2>
                <hr>
                <form action="#" method="post" id="loginForm">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpfFormatado" oninput="formatarCPF(this)" maxlength="14" required>
                    <input type="hidden" id="cpf" name="cpf">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Entrar</button>
                    <!-- Exibir a mensagem de falha ao logar -->
                    <?php if (isset($mensagem)): ?>
                            <div class="mensagem-falha">
                            <?php echo $mensagem; ?>
                            </div>
                    <?php endif; ?>
                </form>
            </div>
            <div class="footer">
                <a href="signinclient.php"><i class="fa-solid fa-dumbbell"></i> Área do cliente</a>
            </div>
        </div>
    </div>
</body>
</html>