<?php
require './config.php'; 

$token = $_GET['token'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/verifyUser.css">
    <link rel="icon" href="./assets/icons/bookitIcon.ico" type="image/x-icon">
    <title>Verificar usuario • Bookit</title>
</head>
<body>
    <?php
    if ($token) {
        $stmt = $conection->prepare("SELECT * FROM usuarios WHERE token_verificacion = ?");
        $stmt->execute([$token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (empty($user)) { 
    ?>
    <main>
        <div class="title-container">
            <div class="bookitTag">
                <span>Bookit</span>
            </div>
            <h2>El token expiró</h2>
        </div>
        <div class="instructions">
            <span>Intentá registrándote nuevamente</span>
        </div>
    </main>
    <?php
            die();
        } 
    }
            /* $stmt = $conection->prepare("UPDATE usuarios SET verificado = 1, token_verificacion = NULL WHERE id_usuario = ?");
            $stmt->execute([$user['id_usuario']]);
    
            $_SESSION['check'] = "OK";
            $_SESSION['username'] = $user['nombre_usuario'];  */
    ?>
    <main>
        <div class="title-container">
            <h1>Verificar cuenta en Bookit</h1>
        </div>
        
        <form action="" method="POST">
            <div class="inputs-container">
                <div class="usernameField-container">
                    <label for="usernameInput">Nombre de usuario</label>
                    <input type="text" name="username" id="usernameInput" maxlength="20">
                </div>
                <div class="passwordField-container">
                    <label for="passwordInput">Contraseña</label>
                    <input type="password" name="password" id="passwordInput" maxlength="50">
                </div>
            </div>

            <div class="submitBtn-container">
                <button id="submitBtn" type="submit">VERIFICAR</button>
                <div id="msg-container" class="msg-container errorMsg-container">
                    <span></span>
                </div>
            </div>
        </form>

        <div class="advice-container">
            <p>Si vos no generaste este registro podés simplemente ignorar esto.<br><br>Tu dirección no será asociada a ninguna cuenta y no tomaremos ninguna acción sin tu confirmación.</p>
        </div>
    </main>

    <script src="./scripts/verifyUser.js" defer></script>
</body>
</html>
