<?php
include('../connection/connection.php');
include('../connection/auth.php');
include('exibirEspacos.php');
?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="access.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
  <title>Home</title>
</head>
<body>

<div class="grid-container">
  <div class="item1">
    <div class="left">
      <div class="logo">
        <img src="../img/logo_bg_black.png" alt="logoblack">
      </div>
      <div class="items">
        <a href="access.php" title="Acesso"><i class="fa-solid fa-fingerprint"></i></a>
        <a href="../account/account.php" title="Conta"><i class="fa-solid fa-user-astronaut"></i></a>
        <a href="#" title="Planos"><i class="fa-solid fa-dumbbell"></i></a>
     </div>
    </div>
    <div class="right">
      <a href="../connection/logout.php" style="text-decoration:none"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
    </div>
  </div>

  <div class="item3">
    <?php mostrarEspaco();?>
  </div>
  <div class="item5">
    <span>Caio Casadei</span>
    <span>Fernando Lorenzeto</span>
    <span>Luiz Gustavo</span>
    <span>Matheus Mendes</span>
  </div>
</div>

</body>
</html>