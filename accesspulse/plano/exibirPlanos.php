<?php
    function mostrarPlanos(){
        include('../connection/connection.php');
        $cpf = $_SESSION['user_cpf'];
        $level = $_SESSION['user_level'];
        if($level == "funcionario"){
            $funcaoFunc = $_SESSION['user_function'];
        }

        $selectPlanos = "SELECT p.idplano, p.nomeplano, p.duracao, p.valorplano,
        (   SELECT GROUP_CONCAT(m.nomemodalidade SEPARATOR ', ')
            FROM contem i
            JOIN modalidade m ON i.modalidade_idmodalidade = m.idmodalidade
            WHERE i.plano_idplano = p.idplano
        ) AS modalidades
        FROM plano p
        ORDER BY p.valorplano";

        $planos = $mysqli->query($selectPlanos);

        // verifica se o plano já foi contratado para não ser contratado
        $verificaPlano = "SELECT plano_idplano FROM membro where cpf = '$cpf'";
        $planoMembro = $mysqli->query($verificaPlano) or die("Falha na execução do código SQL: " . $mysqli->error);
        $IDplanoMembro = $planoMembro->fetch_assoc();

        // Verifica se há resultados
        if ($planos->num_rows > 0) {
            // Exibe os resultados dentro de caixinhas
            while ($row = $planos->fetch_assoc()) {
                echo '<div class="box">
                        <div class="tittle">
                            '.$row['nomeplano'].' ';
                            if($level == "funcionario" && $funcaoFunc == "Gerente"){
                                echo '<i class="fa-solid fa-edit"></i><i onclick="apagaPlano('.$row['idplano'].')" class="fa-solid fa-trash"></i>';
                            }else{
                                echo '<i class="fa-solid fa-dumbbell"></i>';
                            }
                            
                   echo'</div>
                        <div class="price">
                            <label>R$ '.$row['valorplano'].'</label><br>
                        </div>
                        <div class="content">
                            <label>Neste plano você poderá realizar '.$row['modalidades'].' e outras atividades que a academia oferece.</label>
                        </div>
                        ';
                        if($level == "membro"){
                            echo '
                            <div class="buy">';
                                if($IDplanoMembro['plano_idplano'] != $row['idplano']){
                                    echo '<button onclick="mudaPlanoMembro(\''.$cpf.'\', '.$row['idplano'].')">Assinar Plano</button>';
                                }else{
                                    echo '<button style="color:gray;">Plano já Contratado</button>';
                                }
                            echo '</div>';
                        }
                    echo '</div>';
            }
        }else {
            echo "Sem planos cadastrados!";
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'alterarPlano') {
        // Execute a função alterar Plano do membro se a ação for 'alterarPlano'
        alterarPlano();
    }else if(isset($_POST['action']) && $_POST['action'] === 'apagaPlano') {
        apagaPlano();
    }
    

    function alterarPlano(){
        include('../connection/connection.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cpfMembro = $_POST['cpfMembro'];
            $idPlano = $_POST['idPlano'];
            // comando sql para alterar o plano do membro pelo próprio membro
            $updatePlanoMembro = "UPDATE membro SET plano_idplano = $idPlano
                                  WHERE cpf = '$cpfMembro' ";

            if ($mysqli->query($updatePlanoMembro) === TRUE) {
                session_start();
            }else{
                echo "Erro ao alterar o plano. verifique se existem pendências financeiras." . $mysqli->error;
            }
        }
    }

    function apagaPlano(){
        include('../connection/connection.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idPlano = $_POST['idPlano'];
            // comando sql para alterar o plano do membro pelo próprio membro
            $deletePlano = "DELETE FROM plano WHERE idplano = '$idPlano'";

            if ($mysqli->query($deletePlano) === FALSE) {
                echo "Erro ao alterar o plano. verifique se existem pendências financeiras." . $mysqli->error;
            }
        }
    }
?>