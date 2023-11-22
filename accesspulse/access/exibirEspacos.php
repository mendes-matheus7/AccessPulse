<?php
    function mostrarEspaco(){
        include('../connection/connection.php');
        $cpf = $_SESSION['user_cpf'];
        
        $selectEspaco = "SELECT c.plano_idplano, m.nomemodalidade, e.nomeespaco, e.capacidade 
        FROM membro c 
        JOIN plano p ON c.plano_idplano = p.idplano
        JOIN contem i ON p.idplano = i.plano_idplano
        JOIN modalidade m ON i.modalidade_idmodalidade = m.idmodalidade
        JOIN espaco e ON m.utiliza_espaco_idespaco = e.idespaco
        WHERE cpf = $cpf";

        $espaco = $mysqli->query($selectEspaco);

         // Verifica se há resultados
        if ($espaco->num_rows > 0) {
            // Exibe os resultados em uma tabela HTML
            echo "<table border='1'>
                    <tr>
                        <th>Nome da Modalidade</th>
                        <th>Nome do Espaço</th>
                        <th>Capacidade</th>
                    </tr>";

            // Exibe cada linha de resultado
            while ($row = $espaco->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nomemodalidade']}</td>
                        <td>{$row['nomeespaco']}</td>
                        <td>{$row['capacidade']}</td>
                    </tr>";
            }

            echo "</table>";
        }else {
            echo "Sem acessos liberados. Favor consultar a recepção.";
        }
    }
?>