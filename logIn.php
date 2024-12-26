<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/logIn-signUp.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Bookit</title>
</head>
<body>
    
</body>
</html>
    <div class="main-container">
        <div class="form-container">
            <div class="title-container">
                <h1>Iniciar sesión</h1>
            </div>
            <form method="">
                <div class="username-container input-container">
                    <label>nombre de usuario</label>
                    <input type="text" name="username" id="username" maxlength="20">
                </div>
                <div class="key-container input-container">
                    <label>contraseña</label>
                    <input type="password" name="key" id="password" maxlength="50">
                </div>
                <div class="btn-container">
                    <button type="submit">INICIAR SESIÓN</button>
                </div>
            </form>
            <p>¿No tienes una cuenta? <a href="./signUp.php">Regístrate</a></p>
        </div>
    </div>
<?php include('./template/footer.php') ?>