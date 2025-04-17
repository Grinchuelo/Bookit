<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/general.css">
  <link rel="stylesheet" href="./css/index.css">
  <title>Bookit</title>
</head>

<body>
  <div class="main-container">
    <div class="title-container">
      <h1>Regístrate</h1>
    </div>
    <div class="form-container">
      <form method="">
        <div class="labelInput-container email-container">
          <label for="emailInput">Correo electrónico</label>
          <div class="input-container">
            <input type="email" name="email" id="emailInput" class="emailInput noValidateIcon" placeholder="Ingrese su correo electrónico" maxlength="50" onkeyup="fillInput(this)" onblur="validateEmail(this)">
            <div class="svg-container">
              <svg>
                <use id="validationSvg" href=""></use>
              </svg>
              <div class="requirements-container">
                <div class="requirements-element">
                  <span>El correo electrónico no parece válido. Asegúrate de incluir un "@" y un dominio como ".com"</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="labelInput-container username-container">
          <label for="usernameInput">Nombre de usuario</label>
          <div class="input-container">
            <input type="text" name="username" id="usernameInput" class="usernameInput" placeholder="Ingrese un nombre de usuario" maxlength="20" onkeyup="fillInput(this)" onblur="hideRequirements(this)">
            <div class="svg-container">
              <svg onclick="displayRequirements(event, this)">
                <use id="usernameSvg" href="./assets/icons/icons.svg?v=2#info-icon"></use>
              </svg>
              <div class="requirements-container">
                <div class="requirements-element">
                  <div class="svgRequirement-container">
                    <svg>
                      <use href=""></use>
                    </svg>
                  </div>
                  <span>Mínimo 3 caracteres</span>
                </div>
                <div class="requirements-element">
                  <div class="svgRequirement-container">
                    <svg>
                      <use href=""></use>
                    </svg>
                  </div>
                  <span>No usar otro caracter que no sea <b>letra</b>, <b>número</b> o <b>_</b> (guión bajo)</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="labelInput-container password-container">
          <label for="passwordInput">Contraseña</label>
          <div class="input-container">
            <input type="password" name="password" id="passwordInput" placeholder="Ingrese una contraseña" maxlength="50" onkeyup="fillInput(this)" onblur="hideRequirements(this)">
            <div class="svg-container">
              <div class="validationEye-container">
                <svg id="passwordEye">
                  <use id="eyeIcon" href=""></use>
                </svg>
                <svg class="exceptionForDisplay" onclick="displayRequirements(event, this)">
                  <use id="validationSvg" href="./assets/icons/icons.svg?v=2#info-icon"></use>
                </svg>
              </div>
              <div class="requirements-container">
                <div class="requirements-element">
                  <div class="svgRequirement-container">
                    <svg>
                      <use href=""></use>
                    </svg>
                  </div>
                  <span>Mínimo 8 caracteres</span>
                </div>
                <div class="requirements-element">
                  <div class="svgRequirement-container">
                    <svg>
                      <use href=""></use>
                    </svg>
                  </div>
                  <span>Mínimo una letra minúscula</span>
                </div>
                <div class="requirements-element">
                  <div class="svgRequirement-container">
                    <svg>
                      <use href=""></use>
                    </svg>
                  </div>
                  <span>Mínimo una letra mayúscula</span>
                </div>
                <div class="requirements-element">
                  <div class="svgRequirement-container">
                    <svg>
                      <use href=""></use>
                    </svg>
                  </div>
                  <span>Mínimo un número</span>
                </div>
                <div class="requirements-element">
                  <div class="svgRequirement-container">
                    <svg>
                      <use href=""></use>
                    </svg>
                  </div>
                  <span>Mínimo un carácter especial <br>(!, @, #, $, %, -, &, *, etc.)</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="labelInput-container validatePassword-container">
          <label for="validatePasswordInput">Validar contraseña</label>
          <div class="input-container">
            <input type="password" name="validatePasswordInput" class="noValidateIcon" id="validatePasswordInput" placeholder="Ingrese de nuevo la contraseña" maxlength="50" onkeyup="fillInput(this)" onblur="hideRequirements(this)">
            <div class="svg-container">
              <svg>
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
          <button type="submit">REGISTRARME</button>
          <p>¿Ya tienes una cuenta? <a href="./logIn.php">Inicia sesión</a></p>
        </div>
      </form>
    </div>
  </div>

  <script src="./scripts/index.js"></script>
</body>

</html>