<?php
include('./config.php');

// Redirigir a la home si el usuario ya está logeado
if (isset($_SESSION['check'])) {
    header('Location:home.php');
    die();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $key = htmlspecialchars(trim($_POST['key']));

    require('./global/validates.php');

    if(validateUsername($username)) 
    
    $query = $conection->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario AND clave_usuario = :clave_usuario");
    $query->bindParam(':nombre_usuario', $_POST['username']);
    $query->bindParam(':clave_usuario', $_POST['key']);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_LAZY);

    if (!empty($usuario)) {
        $_SESSION['check'] = "OK";
        $_SESSION['username'] = $usuario['nombre_usuario'];
        header('Location:home.php');
    } else {
        $mensaje = "ERROR: nombre de usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/logIn-signUp.css">
    <title>Bookit</title>
</head>
<body>
    <div class="main-container">
        <div class="form-container">
            <div class="title-container">
                <h1>Iniciar sesión</h1>
            </div>
            <?php if(isset($mensaje)) { ?>
            <div class="error-container">
                <span><?php echo $mensaje; ?></span>
            </div>
            <?php } ?>
            <form method="POST">
                <div class="username-container input-container">
                    <label>Nombre de usuario</label>
                    <input type="text" name="username" id="username" maxlength="20">
                </div>
                <div class="key-container input-container">
                    <label>Contraseña</label>
                    <input type="password" name="key" id="password" maxlength="50">
                </div>
                <div class="btn-container">
                    <button type="submit">INICIAR SESIÓN</button>
                </div>
            </form>
            <p>¿No tienes una cuenta? <a href="./signUp.php">Regístrate</a></p>
        </div>
    </div>
</body>
</html>