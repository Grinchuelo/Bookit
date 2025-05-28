<?php
include('./config.php');

if (!$_GET['checked'] == 1) {
    header('Location: preCheck.php?request=login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="./assets/icons/bookitIcon.ico" type="image/x-icon">
    <title>Bookit</title>
</head>
<body>
    <div class="logIn-container">
        <form action="" method="POST">
            <div class="main-container">
                <div class="mainTop-container">
                    <div class="title-container">
                        <svg>
                            <use href="./assets/icons/icons.svg#bookitFullLight-icon"></use>
                        </svg>
                        <h1>Iniciá sesión</h1>
                    </div>
                    <div class="inputs-container">
                        <div class="usernameField-container">
                            <label for="usernameInput">Nombre de usuario</label>
                            <input type="text" name="username" id="usernameInput" maxlength="20" placeholder="Ingresá tu nombre de usuario">
                        </div>
                        <div class="passwordField-container">
                            <label for="passwordInput">Contraseña</label>
                            <div class="passwordInput-container">
                                <input type="password" name="password" id="passwordInput" maxlength="50" placeholder="Ingresá tu contraseña">
                                <svg id="eyeIcon" onclick="viewPassword()">
                                    <use href="./assets/icons/icons.svg#whiteClosedEye-icon"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="submitBtn-container">
                    <button id="submitBtn" type="submit">INICIAR SESIÓN</button>
                    <p>¿No tenés una cuenta? <a href="./signUp.php">Registrate</a></p>
                    <div id="errorMsg-container" class="errorMsg-container">
                        <span>Nombre de usuario o contraseña incorrectos</span>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="./scripts/logIn.js" defer></script>
</body>
</html>