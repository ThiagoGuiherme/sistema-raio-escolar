<?php
include 'config.php';
$h=$conn->query("SELECT * FROM historico_consultas ORDER BY data_consulta DESC");
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-4">
<h3>Histórico de Consultas</h3>
<table class="table table-bordered">
<tr><th>Aluno</th><th>Escola</th><th>Usuário</th><th>Data</th></tr>
<?php while($r=$h->fetch_assoc()){  ?>
<td><?=$r['aluno_nome']?></td>
<td><?=$r['etapa_ensino']?></td>
<td><?=$r['escola_oficial']?></td>
<td><?=$r['usuario']?></td>
<td><?=date('d/m/Y H:i',strtotime($r['data_consulta']))?></td>

<tr>
  <th>Aluno</th>
  <th>Etapa</th>
  <th>Escola</th>
  <th>Usuário</th>
  <th>Data</th>
</tr>

<?php } ?>
</table>
<a href="dashboard.php" class="btn btn-secondary">Voltar</a>
</body>
</html>