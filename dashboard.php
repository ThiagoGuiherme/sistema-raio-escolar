<?php
include 'config.php';
if(!isset($_SESSION['usuario'])) header("Location: login.php");

$escolas = $conn->query("SELECT * FROM escolas");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard – Raio Escolar</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

<style>
#map { height: 480px; }
</style>
</head>

<body class="container p-4">

<h2>📍 Dashboard – Raio Escolar</h2>

<p>
Usuário: <b><?=$_SESSION['usuario']?></b>
(<?=$_SESSION['perfil']?>)
</p>

<div class="mb-3">
<?php if($_SESSION['perfil']=='admin'){ ?>
  <a class="btn btn-primary" href="cad_escola.php">Cadastrar Escola</a>
<?php } ?>
  <a class="btn btn-success" href="cad_aluno.php">Consultar Aluno</a>
  <a class="btn btn-info" href="historico.php">Histórico</a>
  <a class="btn btn-danger" href="logout.php">Sair</a>
</div>

<hr>

<h4>🏫 Localização das Escolas Cadastradas</h4>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
var map = L.map('map').setView([-26.33, -49.91], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
 attribution: '© OpenStreetMap'
}).addTo(map);

<?php while($e = $escolas->fetch_assoc()){ 
  $etapas = [];
  if($e['atende_pre']) $etapas[] = 'Pré';
  if($e['atende_fundamental']) $etapas[] = 'Fundamental';
  if($e['atende_medio']) $etapas[] = 'Médio';
  $textoEtapas = implode(', ', $etapas);
?>
L.marker([<?=$e['latitude']?>, <?=$e['longitude']?>])
 .addTo(map)
 .bindPopup(
   "<b><?=$e['nome']?></b><br>" +
   "Etapas: <?=$textoEtapas?>"
 );
<?php } ?>
</script>

</body>
</html>
