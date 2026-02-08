<?php
include 'config.php';

$nome=$_POST['nome'];
$lat=$_POST['lat'];
$lng=$_POST['lng'];
$etapa=$_POST['etapa'];

if($etapa=='Pré'){
 $condicao = "AND atende_pre=1";
}elseif($etapa=='Fundamental'){
 $condicao = "AND atende_fundamental=1";
}else{
 $condicao = "AND atende_medio=1";
}

$r=$conn->query("
SELECT *,
(6371*acos(
 cos(radians($lat))*cos(radians(latitude))*
 cos(radians(longitude)-radians($lng)) +
 sin(radians($lat))*sin(radians(latitude))
)) AS distancia
FROM escolas
WHERE 1=1 $condicao
ORDER BY distancia ASC
LIMIT 3
");

$lista=$r->fetch_all(MYSQLI_ASSOC);

if(count($lista)==0){
 die('Nenhuma escola compatível encontrada para esta etapa.');
}

$oficial=$lista[0];

$conn->query("
INSERT INTO historico_consultas
(aluno_nome, etapa_ensino, latitude, longitude, escola_oficial, distancia, usuario)
VALUES
('$nome','$etapa','$lat','$lng','{$oficial['nome']}','{$oficial['distancia']}','{$_SESSION['usuario']}')
");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-4">

<h3>🎯 Escola Oficial</h3>

<div class="alert alert-success">
<b><?=$oficial['nome']?></b><br>
Etapa atendida: <?=$etapa?>
</div>

<table class="table table-bordered">
<tr><th>Escola</th><th>Distância (km)</th></tr>
<?php foreach($lista as $e){ ?>
<tr class="<?=$e['id']==$oficial['id']?'table-success':''?>">
<td><?=$e['nome']?></td>
<td><?=round($e['distancia'],2)?></td>
</tr>
<?php } ?>
</table>

<a href="dashboard.php" class="btn btn-secondary">Voltar</a>

</body>
</html>