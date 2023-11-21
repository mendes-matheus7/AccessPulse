<?php
include('../connection/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf        = $_POST['cpf'];
    $nome       = $_POST['nome'];
    $data_nasc  = $_POST['dataNascimento'];
    $endereco   = $_POST['endereco'];
    $telefone   = $_POST['telefone'];
    $senha      = empty($_POST['senha']) ? '0' : $_POST['senha'];
    
    if($senha == 0){
        $updateFunc = "UPDATE funcionario SET
        nome = '$nome',
        datanascimento = '$data_nasc',
        endereco = '$endereco',
        telefone = '$telefone'
        WHERE cpf= '$cpf'";
    }else{
        $updateFunc = "UPDATE funcionario SET
        nome = '$nome',
        datanascimento = '$data_nasc',
        endereco = '$endereco',
        telefone = '$telefone',
        senha = '$senha'
        WHERE cpf= '$cpf'";
    }
    
    if ($mysqli->query($updateFunc) === TRUE) {
        session_start();
        $_SESSION['mensagem_sucesso'] = 'Dados alterados com sucesso!';
        header("Location: account.php");
        exit();
    } else {
        echo "Erro ao cadastrar a usina: " . $mysqli->error;
    }
}
?>