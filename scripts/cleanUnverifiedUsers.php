<?php
require_once '../config.php'; 

$stmt = $conection->prepare("DELETE FROM usuarios WHERE verificado = 0 AND fecha_creacion < (NOW() - INTERVAL 1 DAY)");
$stmt->execute();
?>
