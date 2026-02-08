<?php
include 'config.php';
if($_SESSION['perfil']!='admin') die("Acesso restrito");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=escolas.xls");
echo "Nome\tLatitude\tLongitude\n";
$r=$conn->query("SELECT * FROM escolas");
while($e=$r->fetch_assoc()){
 echo "{$e['nome']}\t{$e['latitude']}\t{$e['longitude']}\n";
}
?>