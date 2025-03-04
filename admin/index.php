<?php
if($_POST) {
    include('../config.php');
    $query = $conection->prepare("SELECT * FROM administradores WHERE nombre_admin=:nombre_admin AND clave_admin=:clave_admin");
    $query->bindParam(':nombre_admin', $_POST['username']);
    $query->bindParam(':clave_admin', $_POST['key']);
    $query->execute();
    $administrador = $query->fetch(PDO::FETCH_LAZY);

    if(!empty($administrador)) {
        session_start();
        $_SESSION['check'] = "OK";
        $_SESSION['username'] = $administrador['nombre_admin'];
        header('Location:dashboard.php');
    } else {
        $mensaje = "ERROR: nombre de administrador o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/generalAdmin.css">
    <title>Ventana de administrador</title>
</head>
<body class="form-body">
    <div class="main-container">
        <div class="form-container">
            <div class="icon-container">
                <svg>
                    <use href="../assets/icons/icons.svg#admin-icon"></use>
                </svg>
            </div>
            <?php if(isset($mensaje)) { ?>
            <div class="error-container">
                <span><?php echo $mensaje; ?></span>
            </div>
            <?php } ?>
            <form method="POST">
                <div class="username-container input-container">
                    <label>nombre de administrador</label>
                    <input type="text" name="username" id="username" maxlength="20" required>
                </div>
                <div class="key-container input-container">
                    <label>contraseña</label>
                    <input type="password" name="key" id="password" maxlength="50" required>
                </div>
                <div class="btn-container">
                    <button type="submit">INGRESAR</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>