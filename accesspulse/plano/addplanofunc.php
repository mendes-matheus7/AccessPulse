<?php
ob_start();


function enviaPlano() {
    include('../connection/connection.php');
    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $duracao = $_POST["duracao"];
    $valorplano = $_POST["valorplano"];

    // Insere os dados no banco de dados
    $sql = "INSERT INTO plano (nomeplano, duracao, valorplano) 
            VALUES ('$nome', '$duracao', $valorplano)";

    if ($mysqli->query($sql) === TRUE) {
        // Redireciona para 'plano.php'
        header("Location: plano.php");
        exit();
    } else {
        http_response_code(500);
        echo "Erro ao adicionar o plano: " . mysqli_error($mysqli);
    }
}

function enviaModalidade(){
    include('../connection/connection.php');
        // Recupera os dados do formulário
        $nome = $_POST["nome"];
        $idespaco = $_POST["idespaco"];

        // Insere os dados no banco de dados
        $sql = "INSERT INTO modalidade (nomemodalidade, utiliza_espaco_idespaco) 
                VALUES ('$nome', $idespaco)";

        if ($mysqli->query($sql) === TRUE) {
            header("Location: plano.php");
            exit();
        } else {
            echo "Erro ao cadastrar: " . mysqli_error($mysqli);
        }
    
}


if (isset($_POST['action']) && $_POST['action'] === 'enviaPlano') {
    // Execute a função alterar Plano do membro se a ação for 'alterarPlano'
    enviaPlano();
}else if(isset($_POST['action']) && $_POST['action'] === 'enviaModalidade') {
    enviaModalidade();
}
?>