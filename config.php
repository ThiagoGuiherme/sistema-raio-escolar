<?php
session_start();
$conn = new mysqli("sql102.infinity.free.com","ifO_41106706","nKU0PYhJ3Wd","ifO_41106706_XXX");
if($conn->connect_error){ die("Erro: ".$conn->connect_error); }
?>