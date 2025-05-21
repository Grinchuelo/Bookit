<?php
header('Content-Type: application/json');
include('../config.php');

$user_id = $_SESSION['user_id'];
$parameter = array_key_first($_GET);
$listName = $_GET['listName'];

$type = $parameter == 'id_libro' ? 'book' : 'saga';
$id_bookORsaga = $type == 'book' ? $_GET['id_libro'] : $_GET['id_saga'];

// Eliminar si ya fue agregado a la lista
if ($type == 'book') {
    $stmt = $conection->prepare("SELECT * FROM listas_agregados INNER JOIN listas ON lista_id = listas.id_lista WHERE listas.nombre_lista = ? AND libro_id = ? AND listas.usuario_id = ?");
    $stmt->execute([$listName, $id_bookORsaga, $user_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} else if ($type == 'saga') {
    $stmt = $conection->prepare("SELECT * FROM listas_agregados INNER JOIN listas ON lista_id = listas.id_lista WHERE listas.nombre_lista = ? AND saga_id = ? AND listas.usuario_id = ?");
    $stmt->execute([$listName, $id_bookORsaga, $user_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!empty($result)) {
    $stmt = $conection->prepare("DELETE FROM listas_agregados WHERE id_listasAgregados = ?");
    $stmt->execute([$result['id_listasAgregados']]);

    ob_clean();
    echo json_encode([
        'success' => true,
        'reason' => 'deleted',
        'message' => 'Se eliminó el libro de la lista'
    ]);
    exit;
}

// Si los parámetros o los valores enviados por GET están mal
$stmt = $conection->prepare("SELECT * FROM listas WHERE usuario_id = ? AND nombre_lista = ?");
$stmt->execute([$user_id, $listName]);
$lista = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($lista)) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'reason' => 'wrongData',
        'message' => 'Error al agregar a lista'
    ]);
    exit;
}

// Si se agregó el libro a la lista
if ($type == 'book') {
    $stmt = $conection->prepare("INSERT INTO listas_agregados(lista_id, saga_id, libro_id) VALUES (?, ?, ?)");
    $stmt->execute([$lista['id_lista'], null, $id_bookORsaga]);
} else if ($type == 'saga') {
    $stmt = $conection->prepare("INSERT INTO listas_agregados(lista_id, saga_id, libro_id) VALUES (?, ?, ?)");
    $stmt->execute([$lista['id_lista'], $id_bookORsaga, null]);
}

ob_clean();
echo json_encode([
    'success' => true,
    'reason' => '',
    'message' => 'Elemento agregado a la lista'
]);
exit;
?>