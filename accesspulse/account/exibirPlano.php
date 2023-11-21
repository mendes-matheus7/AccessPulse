<?php
include('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioCPF = $_POST['usuarioCPF'];
    
    echo "Oi $usuarioCPF";

}
?>