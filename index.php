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
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="./assets/icons/bookitIcon.ico" type="image/x-icon">
    <title>Bookit</title>
</head>
<body>
    <div class="main-container">
        <div class="sub-container">
            <div class="welcome-title">
                <h1>Bienvenido a <span class="underline">Bookit</span></h1>
            </div>
            <div class="sign-container">
                <p>¿Todavía no tienes una cuenta?</p>
                <a href="./signUp.php">Regístrate</a>               
            </div>
            <div class="sign-container">
                <p>¿Ya tienes una cuenta?</p>
                <a href="./logIn.php">Iniciar sesión</a>
            </div>
            <a href="./home.php" class="withoutLogin">Continuar sin iniciar sesión</a>
        </div>
    </div>
</body>
</html>