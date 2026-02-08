<?php include 'config.php'; if(!isset($_SESSION['logado'])) header('Location:login.php'); ?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-4">
<h2>Sistema Raio Escolar</h2>
<a class="btn btn-primary" href="cad_escola.php">Cadastrar Escola</a>
<a class="btn btn-success" href="cad_aluno.php">Consultar Aluno</a>
<a class="btn btn-danger" href="logout.php">Sair</a>
</body>
</html>