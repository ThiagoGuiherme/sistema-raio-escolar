<?php
include 'config.php';
$nome=$_GET['nome']; $lat=$_GET['lat']; $lng=$_GET['lng'];
$n=$conn->query("SELECT COUNT(*) t FROM historico_consultas")->fetch_assoc()['t'];
$r=$conn->query("
SELECT nome,
(6371*acos(
 cos(radians($lat))*cos(radians(latitude))*
 cos(radians(longitude)-radians($lng)) +
 sin(radians($lat))*sin(radians(latitude))
)) AS distancia
FROM escolas ORDER BY distancia ASC LIMIT 1")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-5 text-center">
<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAADUlEQVR42mP8z8BQDwAE/wH+ZK0sWAAAAABJRU5ErkJggg==" width="120"><br><br>
<p><b>Documento Nº <?=$n?></b></p>
<p><?=date('d/m/Y H:i')?> – Responsável: <?=$_SESSION['usuario']?></p>
<p>
Informamos que após consulta ao sistema de raio escolar, constatou-se que o(a) aluno(a)
<b><?=$nome?></b>, localizado(a) nas coordenadas Latitude <b><?=$lat?></b> e Longitude
<b> <p><b>Etapa de Ensino:</b> <?=$etapa?></p>
<?=$lng?></b>, possui como unidade escolar oficial:
<b><?=$r['nome']?></b>.
</p>
<button class="btn btn-warning" onclick="gerar()">Gerar PDF</button>
<a href="dashboard.php" class="btn btn-secondary">Voltar</a>
<script>
function gerar(){
 html2canvas(document.body).then(function(canvas){
  const jsPDF = window.jspdf.jsPDF;
  let pdf=new jsPDF('p','mm','a4');
  let img=canvas.toDataURL('image/png');
  let w=210; let h=canvas.height*w/canvas.width;
  pdf.addImage(img,'PNG',0,0,w,h);
  pdf.save('resultado_raio_escolar.pdf');
 });
}
</script>
</body>
</html>