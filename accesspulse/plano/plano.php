<?php
include('../connection/connection.php');
include('../connection/auth.php');
include('exibirPlanos.php');
if (isset($_SESSION['mensagem_sucesso'])) {
  echo "<script> alert('" . $_SESSION['mensagem_sucesso'] . "');</script>";
  unset($_SESSION['mensagem_sucesso']); // Limpa a mensagem para evitar exibi-la novamente
}
?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="plano.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="plano.js"></script>
  <title>Planos</title>
</head>
<body>

<div class="grid-container">
  <div class="item1">
    <div class="left">
      <div class="logo">
        <img src="../img/logo_bg_black.png" alt="logoblack">
      </div>
      <div class="items">
        <a href="../access/access.php" title="Acesso"><i class="fa-solid fa-fingerprint"></i></a>
        <a href="../account/account.php" title="Conta"><i class="fa-solid fa-user-astronaut"></i></a>
        <a href="plano.php" title="Planos"><i class="fa-solid fa-dumbbell"></i></a>
     </div>
    </div>
    <div class="right">
      <a href="../connection/logout.php" style="text-decoration:none"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
    </div>
  </div>

  <div class="item3">
    <?php
    if($_SESSION['user_level'] == "funcionario" &&  $_SESSION['user_function'] == "Gerente"){
      echo'<div class="escolha">
            <a href="addplano.php">Adicionar Plano</a>
            <a href="addModalidade.php">Adicionar Modalidade</a>
            <a href="addEspaco.php">Adicionar Espaço</a>
          </div>';
    }
    ?>
    
    <div class="conteudo">
      <?php mostrarPlanos(); ?>
    </div>
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