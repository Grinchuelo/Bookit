<?php
include('../conection.php');

$query = $conection->prepare("SELECT * FROM autores");
$query->execute();
$autores = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($autores);
?>