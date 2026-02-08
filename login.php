<?php
include 'config.php';
if(isset($_SESSION['usuario'])) header("Location: dashboard.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sistema de Raio Escolar – Município de Itaiópolis</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
  background: #f2f4f7;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.card-login {
  width: 100%;
  max-width: 420px;
  padding: 30px;
  border-radius: 10px;
}

.logo {
  max-width: 220px;
  margin-bottom: 20px;
}

.titulo {
  font-size: 18px;
  font-weight: 600;
  color: #333;
}

.subtitulo {
  font-size: 14px;
  color: #666;
}
</style>
</head>

<body>

<div class="card shadow card-login text-center">

  <!-- LOGO DO MUNICÍPIO -->
  <img src="Logo-9.png" class="logo" alt="Município de Itaiópolis">

  <div class="titulo">
    Sistema de Raio Escolar
  </div>

  <div class="subtitulo mb-4">
    Secretaria Municipal de Educação
  </div>

  <form method="post">

    <div class="mb-3 text-start">
      <label class="form-label"><b>Usuário</b></label>
      <input class="form-control" name="usuario" required>
    </div>

    <div class="mb-3 text-start">
      <label class="form-label"><b>Senha</b></label>
      <input type="password" class="form-control" name="senha" required>
    </div>

    <button class="btn btn-primary w-100">
      Entrar no Sistema
    </button>

  </form>

  <?php
  if($_POST){
    $u=$_POST['usuario'];
    $s=$_POST['senha'];

    $r=$conn->query("SELECT * FROM usuarios WHERE usuario='$u' AND senha='$s'");
    if($r->num_rows==1){
      $d=$r->fetch_assoc();
      $_SESSION['usuario']=$d['usuario'];
      $_SESSION['perfil']=$d['perfil'];
      header("Location: dashboard.php");
      exit;
    } else {
      echo "<div class='alert alert-danger mt-3'>Usuário ou senha inválidos</div>";
    }
  }
  ?>

  <div class="text-muted mt-4" style="font-size:12px">
    © <?=date('Y')?> Município de Itaiópolis
  </div>

</div>

</body>
</html>
