<?php
include('../connection/connection.php');

echo'<script>
function validarFormulario() {
    var senha = document.getElementById("senha").value;
    var confirmarSenha = document.getElementById("confirmarSenha").value;

    // Validação adicional se necessário
    if (senha !== confirmarSenha) {
        alert("As senhas não coincidem. Por favor, digite novamente.");
        return false; // Impede o envio do formulário
    }

    // Outras validações podem ser adicionadas aqui conforme necessário

    return true; // Permite o envio do formulário se as senhas coincidirem
}
</script>';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuarioCPF'])) {
    $usuarioCPF = $_POST['usuarioCPF'];

    $selectMembro = "SELECT * FROM membro WHERE cpf = $usuarioCPF";
    $membro = $mysqli->query($selectMembro);

    if ($membro->num_rows == 1) {
        // Exibe os dados do membro, com a possibilidade de alteração
        echo '<form action="alterarDadosMembro.php" method="post" onsubmit="return validarSenha()">
                <h4>Seus Dados</h4>
                <hr>';
        while($row = $membro->fetch_assoc()) {
            echo '<label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="' . $row["cpf"] . '" readonly><br>';
            echo ' <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" value="' . $row["nome"] . '"><br>';
            echo '<label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" id="dataNascimento" name="dataNascimento" value="' . $row["datanascimento"] . '"><br>';
            echo '<label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="' . $row["email"] . '"><br>';
            echo '<label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="' . $row["endereco"] . '"><br>';
            echo '<label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" value="' . $row["telefone"] . '"><br>';
            echo '<label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha"><br>';
            echo '<label for="confirmarSenha">Digite a senha novamente:</label>
            <input type="password" id="confirmarSenha" name="confirmarSenha">';
        }
            echo '<span><input type="submit" value="Enviar"></span>';
            echo '</form>';

    } else {
        // se o cpf não corresponder a um membro, então será funcionário
        $selectfunc = "SELECT * FROM funcionario WHERE cpf = $usuarioCPF";
        $funcionario = $mysqli->query($selectfunc);

        if ($funcionario->num_rows > 0) {
            // Exibe os dados do funcionário, com a possibilidade de alteração
            echo '<form action="alterarDadosFuncionario.php" method="post" onsubmit="return validarSenha()">
            <h4>Seus Dados</h4>
            <hr>';
            while($row = $funcionario->fetch_assoc()) {
                echo '<label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="' . $row["cpf"] . '" readonly><br>';
                echo ' <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" value="' . $row["nome"] . '"><br>';
                echo '<label for="dataNascimento">Data de Nascimento:</label>
                <input type="date" id="dataNascimento" name="dataNascimento" value="' . $row["datanascimento"] . '"><br>';
                echo '<label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="' . $row["endereco"] . '"><br>';
                echo '<label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="' . $row["telefone"] . '"><br>';
                echo '<label for="funcao">Função:</label>
                <input type="text" id="funcao" name="funcao" value="' . $row["funcao"] . '" readonly><br>';
                echo '<label for="salario">Salário:</label>
                <input type="text" id="salario" name="salario" value="R$ ' . $row["salario"] . '" readonly><br>';
                echo '<label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha"><br>';
                echo '<label for="confirmarSenha">Digite a senha novamente:</label>
                <input type="password" id="confirmarSenha" name="confirmarSenha">';
            }
                echo '<span><input type="submit" value="Enviar"></span>';
                echo '</form>';
        } else {
            echo 'Nenhum usuário encontrado.';
        }
    }
} else {
    echo 'Requisição inválida.';
}

?>