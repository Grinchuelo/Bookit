<?php
header('Content-Type: application/json');
require('../config.php');

$token = $_GET['token'];
$username = trim($_POST['username']) ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conection->prepare("SELECT * FROM usuarios WHERE token_verificacion = ?");
$stmt->execute([$token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
// En el caso de que falten campos por rellenar
if ($username == '' || $password == '') {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Faltan campos por rellenar',
    ]);
    exit;
}

// En el caso de que el usuario ingresado no exista
if ($username != $user['nombre_usuario'] || !password_verify($password, $user['clave_usuario'])) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Los datos no coinciden',
    ]);
    exit;
} else if ($username == $user['nombre_usuario'] && password_verify($password, $user['clave_usuario'])) { // En el caso de que el usuario exista
    ob_clean();
    echo json_encode([
        'success' => true,
        'message' => 'Verificación exitosa'
    ]);

    // Crea las listas de Deseados y de Comprados del usuario
    date_default_timezone_set('America/Argentina/Cordoba');
    $hoy = date("Y-m-d");
    include('./generateListID.php');

    $stmt = $conection->prepare("SELECT * FROM listas ORDER BY id_lista DESC LIMIT 1");
    $stmt->execute();
    $lastList = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastListID = $lastList['id_lista'];

    // Generar lista deseados
    $stmt = $conection->prepare("INSERT INTO listas(id_lista, nombre_lista, portada_lista, fecha_lista, usuario_id, tipoLista_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([generarSiguienteID($lastListID), 'Deseados', 'deseados_portada', $hoy, $user['id_usuario'], 'des']);
    
    $stmt = $conection->prepare("SELECT * FROM listas ORDER BY id_lista DESC LIMIT 1");
    $stmt->execute();
    $lastList = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastListID = $lastList['id_lista'];

    // Generar lista comprados
    $stmt = $conection->prepare("INSERT INTO listas(id_lista, nombre_lista, portada_lista, fecha_lista, usuario_id, tipoLista_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([generarSiguienteID($lastListID), 'Comprados', 'comprados_portada', $hoy, $user['id_usuario'], 'com']);
    
    $stmt = $conection->prepare("UPDATE usuarios SET verificado = 1, token_verificacion = NULL WHERE id_usuario = ?");
    $stmt->execute([$user['id_usuario']]);

    $stmt = $conection->prepare("DELETE FROM usuarios WHERE nombre_usuario = ? AND verificado = 0");
    $stmt->execute([$username]);

    $_SESSION['check'] = "OK";
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user['id_usuario'];
    $_SESSION['isAdmin'] = false;  
    exit;
}
?>