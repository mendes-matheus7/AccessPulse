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
        // Obter o ID do último registro inserido
        $last_id = $mysqli->insert_id;
        echo "Último ID Inserido: $last_id<br>";

        // Inserir as opções selecionadas na tabela de relacionamento
        if (isset($_POST['modalidades']) && is_array($_POST['modalidades'])) {
            foreach ($_POST['modalidades'] as $modalidade_id) {
                echo "Modalidade ID: $modalidade_id<br>";

                $sql_relacionamento = "INSERT INTO contem (plano_idplano, modalidade_idmodalidade) VALUES ($last_id, $modalidade_id)";

                if ($mysqli->query($sql_relacionamento) === TRUE) {
                    echo "Inserção na tabela contem bem-sucedida!<br>";
                } else {
                    echo "Erro ao inserir na tabela contem: " . $mysqli->error . "<br>";
                }
            }
        }
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
            
            <label for="modalidades">Modalidade:</label>
            <?php
                $consultaMod = "SELECT * FROM modalidade";
                $modalidade = $mysqli->query($consultaMod);
                if ($modalidade->num_rows > 0) {
                    while ($row = $modalidade->fetch_assoc()) {
                        echo '<input type="checkbox" id="'.$row['idmodalidade'].'" name="'.$row['idmodalidade'].'" value="'.$row['idmodalidade'].'">
                        <label for="'.$row['idmodalidade'].'" style="display: inline-block;"> '.$row['nomemodalidade'].'</label><br>';
                    }
                }
            ?>
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
