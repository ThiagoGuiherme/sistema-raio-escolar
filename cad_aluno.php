<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Consulta de Aluno</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

<style>
#map { height: 420px; }
.info { font-size: 14px; color: #555; }
.required::after { content:" *"; color:red; }
</style>
</head>

<body class="container p-4">

<h3>👨‍🎓 Consulta de Aluno – Raio Escolar</h3>

<p class="info">
Informe os dados abaixo para identificar a <b>unidade escolar oficial</b> do aluno,
com base na localização da residência.
</p>

<form action="resultado.php" method="post" onsubmit="return confirmarConsulta();">

<!-- NOME -->
<label class="form-label mt-3 required">
<b>Nome do aluno</b>
</label>
<input
 class="form-control"
 name="nome"
 placeholder="Exemplo: Sofia Maria da Silva"
 required>
<label class="form-label mt-3 required">
<b>Etapa de Ensino</b>
</label>

<select class="form-select" name="etapa" required>
  <option value="">Selecione a etapa</option>
  <option value="Pré">Educação Infantil (Pré)</option>
  <option value="Fundamental">Ensino Fundamental</option>
  <option value="Médio">Ensino Médio</option>
</select>

<!-- COORDENADA ÚNICA -->
<label class="form-label mt-3">
<b>Latitude e Longitude (opcional)</b>
</label>
<input
 class="form-control"
 id="coord"
 placeholder="Exemplo: -26.328177964704874, -49.91228285315451"
 onblur="separarCoordenadas()">

<div class="info mt-1">
Você pode colar as coordenadas copiadas do Google Maps no formato
<b>latitude, longitude</b>.
</div>

<!-- LAT -->
<label class="form-label mt-3 required">
<b>Latitude</b>
</label>
<input
 class="form-control"
 id="lat"
 name="lat"
 placeholder="Exemplo: -26.328177964704874"
 required>

<!-- LNG -->
<label class="form-label mt-3 required">
<b>Longitude</b>
</label>
<input
 class="form-control"
 id="lng"
 name="lng"
 placeholder="Exemplo: -49.91228285315451"
 required>

<p class="info mt-3">
📍 <b>Alternativa:</b> você também pode clicar no mapa abaixo para preencher
automaticamente as coordenadas.
</p>

<div id="map" class="mt-2"></div>

<div class="alert alert-secondary mt-3">
ℹ️ As coordenadas podem ser <b>digitadas</b>, <b>coladas</b> ou <b>selecionadas no mapa</b>.
</div>

<br>

<button class="btn btn-success">
🔍 Consultar Escola
</button>

<a href="dashboard.php" class="btn btn-secondary">
↩ Voltar
</a>

</form>

<!-- MAPA -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
var map = L.map('map').setView([-26.3, -49.9], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
 attribution: '© OpenStreetMap'
}).addTo(map);

var marker = null;

// clique no mapa
map.on('click', function(e) {
 if (marker) map.removeLayer(marker);

 document.getElementById('lat').value = e.latlng.lat;
 document.getElementById('lng').value = e.latlng.lng;
 document.getElementById('coord').value =
   e.latlng.lat + ', ' + e.latlng.lng;

 marker = L.marker(e.latlng)
   .addTo(map)
   .bindPopup("📍 Localização selecionada")
   .openPopup();
});

// separar lat,lng colados
function separarCoordenadas(){
 let valor = document.getElementById('coord').value;

 if(valor.includes(',')){
   let partes = valor.split(',');
   if(partes.length === 2){
     document.getElementById('lat').value = partes[0].trim();
     document.getElementById('lng').value = partes[1].trim();

     let lat = parseFloat(partes[0]);
     let lng = parseFloat(partes[1]);

     if(!isNaN(lat) && !isNaN(lng)){
       if (marker) map.removeLayer(marker);
       map.setView([lat,lng], 15);
       marker = L.marker([lat,lng])
         .addTo(map)
         .bindPopup("📍 Localização informada")
         .openPopup();
     }
   }
 }
}

function confirmarConsulta(){
 return confirm(
  "Confirma a consulta do aluno com base nas coordenadas informadas?"
 );
}
</script>

</body>
</html>
