<?php
header('Content-Type: application/json');
require('../config.php');

$email = trim($_POST['email'] ?? '');                                  //
$username = trim($_POST['username'] ?? '');                            //
$passwordValue = $_POST['password'] ?? '';
$options = [
    'cost' => 11,
    'salt' => bin2hex(openssl_random_pseudo_bytes(16))
];
$password = password_hash($passwordValue, PASSWORD_BCRYPT, $options);  //
$validatePassword = $_POST['validatePassword'] ?? '';                  //
date_default_timezone_set('America/Argentina/Cordoba');
$date = date("Y-m-d H:i:s");                                           //
$token =  bin2hex(random_bytes(32));                                   //

// Si ya existe una cuenta con ese nombre de usuario, devolver error
$stmt = $conection->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($user)) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'El nombre de usuario ya está en uso.',
        'inputError' => 'username'
    ]);
    exit;
}

require('./validations.php');
if (validateEmail($email) && validateUsername($username) && validatePassword($passwordValue)) {
    if ($validatePassword == $passwordValue) {
        ob_clean();
        echo json_encode([
            'success' => true,
            'message' => 'Todos los campos se llenaron correctamente.',
            'inputError' => ''
        ]);

        $stmt = $conection->prepare("INSERT INTO usuarios(nombre_usuario, correo_usuario, clave_usuario, fecha_creacion, token_verificacion) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $date, $token]);

        require('./sendVerificationEmail.php');
        sendVerificationEmail($email, $username, $token);
    } else {
        ob_clean();
        echo json_encode([
            'success' => false,
            'message' => 'Asegurate de completar todos los campos correctamente.',
            'inputError' => ''
        ]);
        exit;
    }
}
?>