<?php
include('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $membroCPF = $_POST['usuarioCPF'];
    
    $membroPlano = "SELECT c.plano_idplano, p.nomeplano, p.duracao, p.valorplano,
    (   SELECT GROUP_CONCAT(m.nomemodalidade SEPARATOR ', ')
        FROM contem i
        JOIN modalidade m ON i.modalidade_idmodalidade = m.idmodalidade
        WHERE i.plano_idplano = p.idplano
    ) AS modalidades
    FROM membro c
    JOIN plano p ON c.plano_idplano = p.idplano
    WHERE cpf = '$membroCPF'";

    $plano = $mysqli->query($membroPlano);
    
    // Verifica se há resultados
    if ($plano->num_rows > 0) {
        // Exibe os resultados em uma tabela HTML
        echo "<table border='1'>
                <tr>
                    <th>Nome do Plano</th>
                    <th>Duração</th>
                    <th>Valor do Plano</th>
                    <th>Nome da Modalidade</th>
                </tr>";

        // Exibe cada linha de resultado
        while ($row = $plano->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['nomeplano']}</td>
                    <td>{$row['duracao']}</td>
                    <td>R$ {$row['valorplano']}</td>
                    <td>{$row['modalidades']}</td>
                </tr>";
        }

        echo "</table>";

        echo '<a href="#">Mudar plano</a>';
    } else {
        echo "Nenhum plano encontrado. Procure a recepção para contratar seu plano.";
    }

}
?>