<?php
include('./config.php');

if (!$_GET['checked'] == 1) {
    header('Location: preCheck.php?request=signup');
    exit;
}

// Redirigir a la home si el usuario ya está logeado
if (isset($_SESSION['check'])) {
    if ($_SESSION['check'] == 'OK') {
        header('Location:home.php');
        exit;
    }
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
    <div class="main-container">
        <div class="title-container">
            <h1>Registrate</h1>
        </div>
        <div class="form-container">
            <form method="POST" id="registerUser-form">
                <div class="labelInput-container email-container">
                    <label for="emailInput">Correo electrónico</label>
                    <div class="input-container emailInput-container">
                        <input type="email" name="email" id="emailInput" class="emailInput noValidateIcon" placeholder="Ingrese su correo electrónico" maxlength="50" required onblur="fillInput(this)">
                        <div class="svg-container">
                            <svg class="noPointerEvents" id="validationEmailSvg" onclick="displayRequirements(event, this)">
                                <use id="validationSvg" href=""></use>
                            </svg>
                            <div class="requirements-container">
                                <div class="requirements-element">
                                    <span>El correo electrónico no parece válido. Asegurate de incluir un "@" y un dominio como ".com"</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="labelInput-container username-container">
                    <label for="usernameInput">Nombre de usuario</label>
                    <div class="input-container usernameInput-container">
                        <input type="text" name="username" id="usernameInput" class="usernameInput" placeholder="Ingrese un nombre de usuario" maxlength="20" required onblur="applyErrorFormatBlurInput(this)" onkeyup="fillInput(this)">
                        <div class="svg-container">
                            <svg onclick="displayRequirements(event, this)">
                                <use id="usernameSvg" href="./assets/icons/icons.svg?v=2#info-icon"></use>
                            </svg>
                            <div class="requirements-container">
                                <div class="requirements-element">
                                    <div class="svgRequirement-container">
                                        <svg>
                                            <use class="usernameReqIcon0 lightGrayInfo-icon" href="./assets/icons/icons.svg?v=2#lightGray-icon"></use>
                                        </svg>
                                    </div>
                                    <span>Mínimo 3 caracteres</span>
                                </div>
                                <div class="requirements-element">
                                    <div class="svgRequirement-container">
                                        <svg>
                                            <use class="usernameReqIcon1 lightGrayInfo-icon" href="./assets/icons/icons.svg?v=2#lightGray-icon"></use>
                                        </svg>
                                    </div>
                                    <span>No usar otro caracter que no sea <b>letra</b>, <b>número</b> o <b>_</b> (guión bajo)</span>
                                </div>
                            </div>
                        </div>
                        <div class="errorUsernameExists">
                            <span>Este nombre de usuario ya está en uso</span>
                        </div>
                    </div>
                </div>
                <div class="labelInput-container password-container">
                    <label for="passwordInput">Contraseña</label>
                    <div class="input-container">
                        <input type="password" name="password" id="passwordInput" class="passwordInput" placeholder="Ingrese una contraseña" maxlength="50" required onkeyup="fillInput(this)">
                        <div class="svg-container">
                            <div class="validationEye-container">
                                <svg id="passwordEye" onclick="viewPassword()">
                                    <use id="eyeIcon" href=""></use>
                                </svg>
                                
                                <svg class="aa exceptionForDisplay" onclick="displayRequirements(event, this)">
                                    <use id="validationSvg" href="./assets/icons/icons.svg?v=2#info-icon"></use>
                                </svg>
                            </div>
                            <div class="requirements-container">
                                <div class="requirements-element">
                                    <div class="svgRequirement-container">
                                        <svg>
                                            <use class="passwordReqIcon0 lightGrayInfo-icon" href="./assets/icons/icons.svg?v=2#lightGray-icon"></use>
                                        </svg>
                                    </div>
                                    <span>Mínimo 8 caracteres</span>
                                </div>
                                <div class="requirements-element">
                                    <div class="svgRequirement-container">
                                        <svg>
                                            <use class="passwordReqIcon1 lightGrayInfo-icon" href="./assets/icons/icons.svg?v=2#lightGray-icon"></use>
                                        </svg>
                                    </div>
                                    <span>Mínimo una letra minúscula</span>
                                </div>
                                <div class="requirements-element">
                                    <div class="svgRequirement-container">
                                        <svg>
                                            <use class="passwordReqIcon2 lightGrayInfo-icon" href="./assets/icons/icons.svg?v=2#lightGray-icon"></use>
                                        </svg>
                                    </div>
                                    <span>Mínimo una letra mayúscula</span>
                                </div>
                                <div class="requirements-element">
                                    <div class="svgRequirement-container">
                                        <svg>
                                            <use class="passwordReqIcon3 lightGrayInfo-icon" href="./assets/icons/icons.svg?v=2#lightGray-icon"></use>
                                        </svg>
                                    </div>
                                    <span>Mínimo un número</span>
                                </div>
                                <div class="requirements-element">
                                    <div class="svgRequirement-container">
                                        <svg>
                                            <use class="passwordReqIcon4 lightGrayInfo-icon" href="./assets/icons/icons.svg?v=2#lightGray-icon"></use>
                                        </svg>
                                    </div>
                                    <span>Mínimo un carácter especial <br>(!, @, #, $, %, -, &, *, etc.)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="labelInput-container validatePassword-container">
                    <label class="disabledLabel" for="validatePasswordInput">Validar contraseña</label>
                    <div class="input-container disabledInput">
                        <input type="password" name="validatePassword" class="validatePasswordInput noValidateIcon" id="validatePasswordInput" placeholder="Ingrese de nuevo la contraseña" maxlength="50" required onblur="applyErrorFormatBlurInput(this)" onkeyup="fillInput(this)" disabled>
                        <div class="svg-container">
                            <svg class="noPointerEvents" onclick="displayRequirements(event, this)">
                                <use id="validationSvg" href=""></use>
                            </svg>
                            <div class="requirements-container">
                                <div class="requirements-element">
                                    <span>Debe coincidir con la contraseña ingresada</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="submitBtn-container">
                    <button id="submitBtn" type="button" onclick="displayMessage(this)">REGISTRARME</button>
                    <div class="errorSubmitMessage">
                        <span id="errorMsg">Asegurate de completar todos los campos correctamente</span>
                    </div>
                    <p>¿Ya tenés una cuenta? <a href="./logIn.php" style="font-weight:500;">Iniciá sesión</a></p>
                </div>
            </form>
        </div>
    </div>

    <div class="confirmEmailModal">
        <div class="confirmEmailModal_msgContainer_loading" id="confirmEmail-container">
            <svg class="loadingSvg">
                <use href="./assets/icons/icons.svg?v=1#loading-icon"></use>
            </svg>
        </div>
    </div>

    <script src="./scripts/index.js" defer></script>
</body>

</html>