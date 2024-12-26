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
    <div class="main-container">
        <div class="form-container">
            <div class="title-container">
                <h1>Regístrate</h1>
            </div>
            <form method="">
                <div class="email-container input-container">
                    <label>correo electrónico</label>
                    <input type="email" name="email" id="email" maxlength="100">
                </div>
                <div class="username-container input-container">
                    <label>nombre de usuario</label>
                    <input type="text" name="username" id="username" maxlength="20">
                </div>
                <div class="key-container input-container">
                    <label>contraseña</label>
                    <input type="password" name="key" id="password" maxlength="50">
                </div>
                <div class="btn-container">
                    <button type="submit">REGISTRARME</button>
                </div>
            </form>
            <p>¿Ya tienes una cuenta? <a href="./logIn.php">Inicia sesión</a></p>
        </div>
    </div>
</body>
</html>