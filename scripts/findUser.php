<?php
header('Content-Type: application/json');
require('../config.php');

$username = trim($_POST['username']) ?? '';
$password = $_POST['password'] ?? '';

if ($username == '' || $password == '') {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => "Asegurate de completar todos los campos correctamente"
    ]);
    exit;
}

$stmt = $conection->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ? AND verificado = 1");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($username != $user['nombre_usuario'] || !password_verify($password, $user['clave_usuario'])) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => "Nombre de usuario o contraseña incorrectos"
    ]);
    exit;
} else {
    ob_clean();
    echo json_encode([
        'success' => true,
    ]);

    include('../setCookies.php');
    session_start();
    $_SESSION['check'] = 'OK';
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user['id_usuario'];
    $_SESSION['isAdmin'] = false;
    exit;
}
?>