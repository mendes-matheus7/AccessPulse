<?php

if(!isset($_SESSION)) {
    session_start();
}


if(!isset($_SESSION['user_cpf'])) {
    die("Erro de autenticação! Favor efetuar login novamente.<p><a href=\"../signinclient.php\">Entrar</a></p>");
}

?>