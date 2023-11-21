<?php

$user = 'root';
$pwd = '';
$database = 'accesspulse';
$host = 'localhost';

$mysqli = new mysqli($host, $user, $pwd, $database);

if( $mysqli->error ) {
    die("Falha ao conectar ao banco de dados" . $mysqli->error);
}