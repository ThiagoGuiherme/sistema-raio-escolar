<?php
session_start();          // inicia a sessão
$_SESSION = [];           // limpa todas as variáveis
session_destroy();        // destrói a sessão
header("Location: login.php");
exit;
