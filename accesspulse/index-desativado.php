<?php
include('connection/connection.php');
include('connection/auth.php');
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
  <title>Home</title>
</head>
<body>

<div class="grid-container">
  <div class="item1">
    <div class="left">
      <div class="logo">
        <img src="img/logo_bg_black.png" alt="logoblack">
      </div>
      <div class="items">
        <a href="index.php" title="Início"><i class="fa-solid fa-house"></i></a>
        <a href="account/account.php" title="Conta"><i class="fa-solid fa-user-astronaut"></i></a>
        <a href="#" title="Planos"><i class="fa-solid fa-dumbbell"></i></a>
        <a href="#" title="Acesso"><i class="fa-solid fa-fingerprint"></i></a>
      </div>
    </div>
    <div class="right">
      <a href="connection/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
  </div>

  <div class="item2">Menu</div>
  <div class="item3">Main</div>
  <div class="item5">Footer</div>
</div>

</body>
</html>