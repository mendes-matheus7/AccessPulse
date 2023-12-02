<?php
include('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $idespaco = $_POST["idespaco"];

    // Insere os dados no banco de dados
    $sql = "INSERT INTO modalidade (nomemodalidade, utiliza_espaco_idespaco) 
            VALUES ('$nome', $idespaco)";

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
  <title>Add Modalidade</title>
</head>
<body>
    <div class="cadastro-container">
        <div class="logo-container">
            <img src="../img/logo_pink.png" alt="logo" style="max-width: 100%;">
        </div>

        <h2>Nova Modalidade</h2>
        <form action="#" method="post" id="ModalidadeForm">
            <label for="nome">Nome da Modalidade:</label>
            <input type="text" id="nome" name="nome" required>
            
            <label for="Espaco">Espaço que irá utilizar:</label>
            <select id="idespaco" name="idespaco">
                <?php
                    $sltespaco = "SELECT * FROM espaco";
                    $espaco = $mysqli->query($sltespaco);
                    if ($espaco->num_rows > 0) {
                        while ($row = $espaco->fetch_assoc()) {
                            echo '<option  value="'.$row['idespaco'].'">'.$row['nomeespaco'].'</option>';
                        }
                    } else{
                        echo '<option value="" disabled selected>Nenhum espaço disponível</option>';
                    }
                ?>
            </select>

            <button type="submit" onclick="enviaModalidade()">Cadastrar</button>
        </form>
    </div>
</body>
</html>
