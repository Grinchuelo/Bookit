<?php
header('Content-Type: application/json');
require('../../../config.php');

$admin_name = trim($_POST['admin_name']) ?? '';
$admin_password = $_POST['admin_password'] ?? '';

if ($admin_name == '' || $admin_password == '') {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Asegurate de llenar todos los campos correctamente'
    ]);
    exit;
}

$stmt = $conection->prepare("SELECT * FROM administradores WHERE nombre_admin = ? AND clave_admin = ?");
$stmt->execute([$admin_name, $admin_password]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($admin)) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Error: Nombre de administrador o contraseña inválidos'
    ]);
    exit;
} else {
    ob_clean();
    echo json_encode([
        'success' => true,
        'message' => ''
    ]);

    $_SESSION['check'] = 'OK';
    $_SESSION['username'] = $admin_name;
    $_SESSION['isAdmin'] = true;
}
?>