<?php
include 'config.php';
$escolas = $conn->query("SELECT * FROM escolas");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-4">
<h3>📄 Relatório Gerencial de Escolas</h3>
<table class="table table-bordered">
<tr><th>Nome</th><th>Latitude</th><th>Longitude</th></tr>
<?php while($e=$escolas->fetch_assoc()){ ?>
<tr>
<td><?=$e['nome']?></td>
<td><?=$e['latitude']?></td>
<td><?=$e['longitude']?></td>
</tr>
<?php } ?>
</table>

<button class="btn btn-warning" onclick="exportPDF()">Exportar PDF</button>

<script>
function exportPDF(){
 html2canvas(document.body).then(canvas=>{
  const {jsPDF}=window.jspdf;
  let pdf=new jsPDF('p','mm','a4');
  let img=canvas.toDataURL('image/png');
  let w=210;
  let h=canvas.height*w/canvas.width;
  pdf.addImage(img,'PNG',0,0,w,h);
  pdf.save('relatorio_gerencial.pdf');
 });
}
</script>
</body>
</html>