<?php
include 'config.php';
if($_SESSION['perfil']!='admin') die("Acesso restrito");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Cadastrar Escola</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<style>#map{height:420px}</style>
</head>
<body class="container p-4">

<h3>🏫 Cadastro de Escola</h3>

<form action="salva_escola.php" method="post">

<label class="form-label mt-3"><b>Nome da Escola</b></label>
<input class="form-control" name="nome" required>

<label class="form-label mt-3"><b>Etapas de Ensino Atendidas</b></label>

<div class="form-check">
 <input class="form-check-input" type="checkbox" name="pre" value="1">
 <label class="form-check-label">Educação Infantil (Pré)</label>
</div>

<div class="form-check">
 <input class="form-check-input" type="checkbox" name="fundamental" value="1">
 <label class="form-check-label">Ensino Fundamental</label>
</div>

<div class="form-check">
 <input class="form-check-input" type="checkbox" name="medio" value="1">
 <label class="form-check-label">Ensino Médio</label>
</div>

<label class="form-label mt-3"><b>Latitude</b></label>
<input class="form-control" id="lat" name="lat" required>

<label class="form-label mt-3"><b>Longitude</b></label>
<input class="form-control" id="lng" name="lng" required>

<div id="map" class="mt-2"></div><br>

<button class="btn btn-primary">Salvar</button>
<a href="dashboard.php" class="btn btn-secondary">Voltar</a>

</form>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
var map=L.map('map').setView([-26.3,-49.9],13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
var m;
map.on('click',e=>{
 if(m) map.removeLayer(m);
 lat.value=e.latlng.lat;
 lng.value=e.latlng.lng;
 m=L.marker(e.latlng).addTo(map);
});
</script>

</body>
</html>