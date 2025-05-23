<?php
// Si el usuario está logeado, redirigir a la home
session_start();

if (isset($_SESSION['check'])) {
    header('Location:home.php');
    die();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="./assets/icons/bookitIcon.ico" type="image/x-icon">
    <title>Bookit</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');

        * {
            font-family: 'Outfit';
        }
    </style>

</head>
<body>
    <div class="indexMain-container">
        <div class="sub-container">
            <div class="sub-sub-container">
                <div class="welcome-title">
                    <h1>Bienvenido a</h1>
                    <svg>
                        <use href="./assets/icons/icons.svg#bookitFullLight-icon"></use>
                    </svg>
                </div>
                <div class="signs-container">
                    <div class="sign-container">
                        <p>¿Todavía no tenés una cuenta?</p>
                        <a href="./signUp.php">REGISTRATE</a>               
                    </div>
                    <div class="sign-container">
                        <p>¿Ya tenés una cuenta?</p>
                        <a href="./logIn.php">INICIÁ SESIÓN</a>
                    </div>
                </div>
            </div>
            <a href="./home.php" class="withoutLogin">Continuar sin iniciar sesión</a>
        </div>
    </div>
</body>
</html>