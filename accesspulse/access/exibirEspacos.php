<?php
    function mostrarEspaco(){
        include('../connection/connection.php');
        $cpf = $_SESSION['user_cpf'];
        $level = $_SESSION['user_level'];
        
        $selectEspaco = "SELECT c.plano_idplano, m.nomemodalidade, e.nomeespaco, e.capacidade, e.idespaco 
        FROM membro c 
        JOIN plano p ON c.plano_idplano = p.idplano
        JOIN contem i ON p.idplano = i.plano_idplano
        JOIN modalidade m ON i.modalidade_idmodalidade = m.idmodalidade
        JOIN espaco e ON m.utiliza_espaco_idespaco = e.idespaco
        WHERE cpf = $cpf";

        $espaco = $mysqli->query($selectEspaco);

         // Verifica se há resultados
        if ($espaco->num_rows > 0) {
            // Exibe os resultados dentro de caixinhas
            while ($row = $espaco->fetch_assoc()) {
                echo '<div class="box">
                        <label>'.$row['nomemodalidade'].'</label><br>
                        <i onclick="AcessarEspaco('.$row['idespaco'].', \''.$cpf.'\', \''.$level.'\')" class="fa-solid fa-fingerprint"></i><br>
                        <label>'.$row['nomeespaco'].'</label>
                    </div>';
            }

            echo "</table>";
        }else {
            echo "Sem acessos liberados. Favor consultar a recepção.";
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'acessar') {
        // Execute a função acessar o espaço  se a ação for 'acessar'
        acessar();
    }

    function acessar(){
        include('../connection/connection.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idEspaco = $_POST['idEspaco'];
            $cpfUsuario = $_POST['cpfUsuario'];
            // comando sql para inserir na tabela acesso o acesso realizado pelo membro
            $insertEspaco = "INSERT INTO acesso_membro(horaentrada, membro_cpf_membro, espaco_idespaco)
                             VALUES (NOW(), '$cpfUsuario', $idEspaco)";

            if ($mysqli->query($insertEspaco) === FALSE) {
                echo "Acesso Negado!" . $mysqli->error;
            }
        }
    }
?>