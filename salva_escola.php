<?php
include 'config.php';
if($_SESSION['perfil']!='admin') die("Acesso restrito");

$nome=$_POST['nome'];
$lat=$_POST['lat'];
$lng=$_POST['lng'];

$pre = isset($_POST['pre']) ? 1 : 0;
$fundamental = isset($_POST['fundamental']) ? 1 : 0;
$medio = isset($_POST['medio']) ? 1 : 0;

if($pre==0 && $fundamental==0 && $medio==0){
 die("Selecione ao menos uma etapa de ensino.");
}

$conn->query("
INSERT INTO escolas
(nome, latitude, longitude, atende_pre, atende_fundamental, atende_medio)
VALUES
('$nome','$lat','$lng',$pre,$fundamental,$medio)
");

header("Location: dashboard.php");
?>