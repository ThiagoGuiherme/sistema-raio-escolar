<?php
include 'config.php';
$h = $conn->query("SELECT * FROM historico_consultas ORDER BY data_consulta DESC");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</head>
<body class="container p-4">

<h3>📄 Histórico de Consultas – Exportação PDF</h3>

<p class="text-muted">
Clique em <b>Gerar PDF</b> para exportar o histórico completo de consultas.
</p>

<table class="table table-bordered">
<tr>
 <th>Aluno</th>
 <th>Etapa</th>
 <th>Escola</th>
 <th>Usuário</th>
 <th>Data</th>
</tr>

<?php while($r = $h->fetch_assoc()){ ?>
<tr>
 <td><?=$r['aluno_nome']?></td>
 <td><?=$r['etapa_ensino']?></td>
 <td><?=$r['escola_oficial']?></td>
 <td><?=$r['usuario']?></td>
 <td><?=date('d/m/Y H:i', strtotime($r['data_consulta']))?></td>
</tr>
<?php } ?>
</table>

<br>

<button class="btn btn-warning" onclick="gerarPDF()">
📄 Gerar PDF
</button>

<a href="dashboard.php" class="btn btn-secondary">
↩ Voltar
</a>

<script>
function gerarPDF(){
 html2canvas(document.body).then(function(canvas){
  const jsPDF = window.jspdf.jsPDF;
  let pdf = new jsPDF('p','mm','a4');

  let img = canvas.toDataURL('image/png');
  let w = 210;
  let h = canvas.height * w / canvas.width;

  pdf.addImage(img,'PNG',0,0,w,h);
  pdf.save('historico_consultas.pdf');
 });
}
</script>

</body>
</html>
