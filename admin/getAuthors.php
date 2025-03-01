<?php
include('../config.php');

header('Content-Type: application/json');

$inputQuery = trim($_GET['query']);

// Le da más prioridad a los nombres que comienzan con determinada sentencia de caracteres
$query = $conection->prepare("SELECT * FROM autores WHERE nombre_autor LIKE :firstCondition OR nombre_autor LIKE :secCondition OR nombre_autor LIKE :thirdCondition ORDER BY CASE WHEN nombre_autor LIKE :firstCondition THEN 1 WHEN nombre_autor LIKE :secCondition THEN 2 ELSE 3 END, nombre_autor LIMIT 10;");
$query->bindValue(':firstCondition', $inputQuery.'%', PDO::PARAM_STR);
$query->bindValue(':secCondition', ' '.$inputQuery.'%', PDO::PARAM_STR);
$query->bindValue(':thirdCondition', '%'.$inputQuery.'%', PDO::PARAM_STR);
$query->execute();
$autores = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($autores); // JSON_UNESCAPED_UNICODE admite caracteres especiales como acentos y demás
?>