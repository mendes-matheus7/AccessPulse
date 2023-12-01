<?php
include('../connection/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf        = $_POST['cpf'];
    $nome       = $_POST['nome'];
    $data_nasc  = $_POST['dataNascimento'];
    $email      = $_POST['email'];
    $endereco   = $_POST['endereco'];
    $telefone   = $_POST['telefone'];
    $senha      = empty($_POST['senha']) ? '0' : $_POST['senha'];
    
    if($senha == 0){
        $updateMembro = "UPDATE membro SET
        nome = '$nome',
        datanascimento = '$data_nasc',
        email = '$email',
        endereco = '$endereco',
        telefone = '$telefone'
        WHERE cpf= '$cpf'";
    }else{
        $updateMembro = "UPDATE membro SET
        nome = '$nome',
        datanascimento = '$data_nasc',
        email = '$email',
        endereco = '$endereco',
        telefone = '$telefone',
        senha = '$senha'
        WHERE cpf= '$cpf'";
    }
    
    if ($mysqli->query($updateMembro) === TRUE) {
        session_start();
        $_SESSION['mensagem_sucesso'] = 'Dados alterados com sucesso!';
        header("Location: account.php");
        exit();
    } else {
        echo "Erro ao alterar dados!" . $mysqli->error;
    }
}
?>