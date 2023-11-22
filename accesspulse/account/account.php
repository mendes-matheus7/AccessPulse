<?php
include('../connection/connection.php');
include('../connection/auth.php');

if (isset($_SESSION['mensagem_sucesso'])) {
  echo "<script> alert('" . $_SESSION['mensagem_sucesso'] . "');</script>";
  unset($_SESSION['mensagem_sucesso']); // Limpa a mensagem para evitar exibi-la novamente
}
$cpf = $_SESSION['user_cpf'];
?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../styles/template.css">
  <link rel="stylesheet" href="account.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="account.js"></script>
  <title>Conta</title>
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
        <a href="account.php" title="Conta"><i class="fa-solid fa-user-astronaut"></i></a>
        <a href="#" title="Planos"><i class="fa-solid fa-dumbbell"></i></a>
      </div>
    </div>
    <div class="right">
      <a href="../connection/logout.php" style="text-decoration:none"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
    </div>
  </div>

  <div class="item2">
    <ul>
        <li onclick="showInformation(1, '<?php echo htmlspecialchars($cpf, ENT_QUOTES, 'UTF-8'); ?>')">
            <span><i class="fa-solid fa-address-card"></i></span>
            <span class="maintext">Seus Dados</span>
        </li>
        

        <li  onclick="showInformation(2, '<?php echo htmlspecialchars($cpf, ENT_QUOTES, 'UTF-8'); ?>')" <?php if($_SESSION['user_level'] == "funcionario"){ echo 'style="display:none"';}?>>
            <span><i class="fa-solid fa-dumbbell"></i></span>
            <span class="maintext">Seu Plano</span>
        </li>
        <li onclick="showInformation(4)" <?php if($_SESSION['user_level'] == "funcionario"){ echo 'style="display:none"';}?>>
            <span><i class="fa-solid fa-credit-card"></i></span>
            <span class="maintext">Financeiro</span>
        </li>
        <li onclick="showInformation(3)">
            <span><i class="fa-solid fa-fingerprint"></i></span>
            <span class="maintext">Seu Acesso</span>
        </li>
    </ul>
  </div>
  <div class="item3">
    <div id="dados" class="dados">
      <!-- Aqui será exibido os dados do cliente ou do funcionário -->
      <div id="info" class="info"></div>
    </div>
    <div id="plano" class="plano">
      <div id="infoPlano" class="info"></div>
    </div>
    <div id="acesso" class="acesso">
      Meu acesso
    </div>
    <div id="financeiro" class="financeiro">
      Minhas finanças
    </div>
  </div>
  <div class="item5">
    <span>Caio Casadei</span>
    <span>Fernando Lorenzeto</span>
    <span>Luiz Gustavo</span>
    <span>Matheus Mendes</span>
  </div>
</div>

<script>
  window.onload = showInformation(1, '<?php echo htmlspecialchars($cpf, ENT_QUOTES, 'UTF-8'); ?>');
</script>
</body>
</html>