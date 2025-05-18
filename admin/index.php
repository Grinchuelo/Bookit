<?php
require('../config.php');
if (isset($_SESSION['check'])) {
    $_SESSION = array();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="./css/generalAdmin.css">
    <link rel="icon" href="../assets/icons/bookitLightIcon.ico" type="image/x-icon">
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
            <div class="error-container">
                <span></span>
            </div>
            <form action="" method="POST">
                <div class="username-container input-container">
                    <label>Nombre de administrador</label>
                    <input type="text" name="admin_name" id="username" maxlength="20">
                </div>
                <div class="key-container input-container">
                    <label>Contraseña</label>
                    <input type="password" name="admin_password" id="password" maxlength="50">
                </div>
                <div class="btn-container">
                    <button type="submit">INGRESAR</button>
                </div>
            </form>
        </div>
    </div>

    <script src="./scripts/js/index.js"></script>
</body>
</html>