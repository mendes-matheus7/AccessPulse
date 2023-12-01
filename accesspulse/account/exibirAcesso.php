<?php
include('../connection/connection.php');
session_start();
$level = $_SESSION['user_level'];
$cpf = $_SESSION['user_cpf'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if($level == "membro"){
        // comando sql
        $selectAcesso = "SELECT a.horaentrada, a.horasaida, e.nomeespaco FROM acesso_membro a
                         JOIN espaco e ON e.idespaco = a.espaco_idespaco
                         WHERE membro_cpf_membro = '$cpf'";

        $mostraAcesso = $mysqli->query($selectAcesso);
        
        // Verifica se há resultados
        if ($mostraAcesso->num_rows > 0) {
            // Exibindo a tabela
            echo '<div class="tabela-scroll">
            <table>
            <tr>
                <th>Local de Acesso</th>
                <th>Data de Entrada</th>
                <th>Hora de Entrada</th>
            </tr>';
            while ($row = $mostraAcesso->fetch_assoc()) {
                // Convertendo as datas e horas
                $dataEntrada = date('Y-m-d', strtotime($row['horaentrada']));
                $horaEntrada = date('H:i:s', strtotime($row['horaentrada']));
                
                echo '<tr>';
                echo '<td>' . $row['nomeespaco'] . '</td>';
                echo '<td>' . $dataEntrada . '</td>';
                echo '<td>' . $horaEntrada . '</td>';
                echo '</tr>';
            }
            echo '</table></div>';
        } else {
            echo "Sem dados de acesso encontrado";
        }
    }else if ($level =="funcionario"){
        echo "funcionario";
    }
}
?>