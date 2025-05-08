/* ************* GLOBAL ************* */
let timeoutId;
// Permite saber si la contraseña tiene el estilo de blurreo para así
// cambiar el color del svg entre blanco y azul debido al cambio de fondo
let isPasswordBlurred = false;
let eyeColor = "white"; // Puede alternar entre white y blue

// ESTILOS DINÁMICOS PARA LOS INPUTS
function successFormatInput(inputElement, inputContainer, requirementsContainer, svg) {
    inputContainer.style.borderBottom = "solid 1px #fff";
    inputContainer.style.borderRadius = "0px";
    inputContainer.style.backgroundColor = "transparent";
    inputElement.style.color = "#fff";
    inputElement.classList.remove("placeholderBlue");
    inputElement.classList.add("placeholderWhite");
    requirementsContainer.classList.remove('display');
    svg.setAttribute('href', './assets/icons/icons.svg#roundedGreenCheck-icon');

    if (inputElement.classList.contains('passwordInput')) {
        const passwInput = document.querySelector('.passwordInput');
        eyeColor = "white";
        if (passwInput.getAttribute('type') == 'password') {
            eyeIcon.setAttribute('href', `./assets/icons/icons.svg#${eyeColor}ClosedEye-icon`)
        } else if (passwInput.getAttribute('type') == 'text') {
            eyeIcon.setAttribute('href', `./assets/icons/icons.svg#${eyeColor}Eye-icon`);
        }
    }
    if (inputElement.classList.contains('emailInput')) {
        const validationEmailSvg = document.getElementById('validationEmailSvg');
        validationEmailSvg.removeAttribute('onclick');
    }

    validateAllInputs();
}

function errorFormatInput(inputContainer, requirementsContainer, svg) {
    svg.setAttribute('href', './assets/icons/icons.svg#redError-icon');
    inputContainer.style.borderBottom = "solid 2px #E72323";
    let requirementsContainers = document.querySelectorAll('.requirements-container');
    if (!requirementsContainer.classList.contains('display')) {
        requirementsContainers.forEach(e => {
            if (e.classList.contains('display')) {
                e.classList.remove('display')
            }
        })
        requirementsContainer.classList.add('display');
    }
    if (inputContainer.classList.contains('emailInput-container')) {
        const validationEmailSvg = document.getElementById('validationEmailSvg');
        validationEmailSvg.setAttribute('onclick', 'displayRequirements(event, this)');
    }
}

// En caso de que el usuario blurree el input sobre el que escribió
function errorFormatBlurInput(inputElement, inputContainer, requirementsContainer, svg) {
    if (inputContainer.style.backgroundColor == "#FFE2E2") {
        return;
    }
    if (inputElement.value.length > 0) {
        inputContainer.style.borderRadius = "1rem";
        inputContainer.style.backgroundColor = "#FFE2E2";
        inputElement.style.color = "#3783F5";
        inputElement.classList.add("placeholderBlue");
        svg.setAttribute('href', './assets/icons/icons.svg#redError-icon');
        inputContainer.style.borderBottom = "solid 2px #E72323";
        let requirementsContainers = document.querySelectorAll('.requirements-container');
        if (!requirementsContainer.classList.contains('display')) {
            requirementsContainers.forEach(e => {
                if (e.classList.contains('display')) {
                    e.classList.remove('display')
                }
            })
            requirementsContainer.classList.add('display');
        }

        if (inputElement.classList.contains('passwordInput')) {
            const passwInput = document.querySelector('.passwordInput');
            eyeColor = "blue";
            if (passwInput.getAttribute('type') == 'password') {
                eyeIcon.setAttribute('href', `./assets/icons/icons.svg#${eyeColor}ClosedEye-icon`)
            } else if (passwInput.getAttribute('type') == 'text') {
                eyeIcon.setAttribute('href', `./assets/icons/icons.svg#${eyeColor}Eye-icon`);
            }
        }
    }
}

function defaultFormatInput(inputElement, inputContainer, requirementsContainer, svg) {
    inputContainer.style.borderBottom = "solid 1px #fff";
    inputContainer.style.borderRadius = "0px";
    inputContainer.style.backgroundColor = "transparent";
    inputElement.style.color = "#fff";
    inputElement.classList.remove("placeholderBlue");
    inputElement.classList.add("placeholderWhite");
    requirementsContainer.classList.remove('display');

    if (inputElement.classList.contains('usernameInput') || inputElement.classList.contains('passwordInput')) {
        svg.setAttribute('href', './assets/icons/icons.svg#info-icon');

        let lightGrayInfo_Icons = inputElement.parentNode.querySelectorAll('.lightGrayInfo-icon');
        lightGrayInfo_Icons.forEach(e => {
            e.setAttribute('href', './assets/icons/icons.svg?v=2#lightGray-icon');
        })
    } else {
        svg.setAttribute('href', '');        
    }

    if (inputElement.classList.contains('passwordInput')) {
        eyeColor = "white";
        const eyeIcon = document.getElementById('eyeIcon');
        eyeIcon.setAttribute('href', '');
    }
}



// Validación de los campos de registro de usuario
function validateEmail(email) {
    const formatEmail = /^[a-zA-Z0-9._-]+\@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return formatEmail.test(email);
}
function validateUsername(username) {
    const formatUsername = /^([a-zA-Z0-9_ ]){3,}$/;    
    const min3Chars = /^.{3,}$/; // Mínimo 3 caracteres
    const charsAllowed = /^[a-zA-Z0-9_ ]+$/; // No usar otro caracter además de a-zA-Z0-9_
    return [formatUsername.test(username), min3Chars.test(username), charsAllowed.test(username)];
}
function validatePassword(password) {
    const formatPassword = /^(?=(?:.*\d){1})(?=(?:.*[A-Z]){1})(?=(?:.*[a-z]){1})(?=(?:.*[!"#\$%\&'\(\)\*\+\,\-\.\/\:\;\<\=\>\?\@\[\\\]\^\_\`\{\|\}\~ ]){1}).{8,}$/; 
    const min8chars = /^.{8,}$/; // Mínimo 8 caracteres
    const lowerCase = /(?=.*?[a-z])/; // Mínimo una letra minúscula
    const upperCase = /(?=.*?[A-Z])/; // Mínimo una letra mayúscula
    const number = /(?=.*?[0-9])/; // Mínimo un número
    const specialChar = /(?=.*?[\~\!\¡\@\#\$\%\^\&\*\(\)\_\-\+\=\{\}\[\]\|\/\\\.\:\;\'\"\<\>\?\¿ ])/; // Mínimo un caracter especial
    
    let validatePasswordInput = document.querySelector('.disabledInput');
    let validatePasswordLabel = document.querySelector('.disabledLabel');

    if (formatPassword.test(password)) {
        validatePasswordInput.style.borderBottom="solid 1px #FFF";
        validatePasswordInput.firstElementChild.removeAttribute('disabled');
        validatePasswordLabel.style.color="#FFF";
    } else {
        validatePasswordInput.style.borderBottom="solid 1px #BDE1FF";
        validatePasswordInput.firstElementChild.setAttribute('disabled', true);
        validatePasswordLabel.style.color="#BDE1FF";
    }
    
    return [formatPassword.test(password), min8chars.test(password), lowerCase.test(password), upperCase.test(password), number.test(password), specialChar.test(password)];
}
function validateValidatePassword(validatePassword, passwordInput) {
    return validatePassword == passwordInput.value;
}
function validateAllInputs() {
    let emailInput = document.querySelector('.emailInput');
    let usernameInput = document.querySelector('.usernameInput');
    let passwordInput = document.querySelector('.passwordInput');
    let validatePasswordInput = document.querySelector('.validatePasswordInput');
    let btnSubmit = document.getElementById('submitBtn');
    if (validateEmail(emailInput.value) && validateUsername(usernameInput.value)[0] && validatePassword(passwordInput.value)[0] && validateValidatePassword(validatePasswordInput.value, passwordInput)) {
        if (btnSubmit.getAttribute('type') == "button") {
            btnSubmit.setAttribute('type', 'submit');
            btnSubmit.removeAttribute('onclick');
        }
    } else {
        if (btnSubmit.getAttribute('type') == "submit") {
            btnSubmit.setAttribute('type', 'button');
            btnSubmit.setAttribute('onclick', 'displayMessage(this)');
        }
    }
}
// Permite que si el usuario altera el campo password, se verifique también el contenido de
// validatePassword y tirar success o error en ese campo dependiendo de si su contenido es igual
// o no al de password
function dynamicValidatePassword(validatePassword) {
    let svg = validatePassword.nextElementSibling.firstElementChild.firstElementChild;
    svg.parentNode.classList.remove('noPointerEvents');
    const inputContainer = validatePassword.parentNode;
    const requirementsContainer = validatePassword.nextElementSibling.firstElementChild.nextElementSibling;

    if (validatePassword.value.length > 0 && validateValidatePassword(validatePassword.value, document.querySelector('.passwordInput'))) {
        successFormatInput(validatePassword, inputContainer, requirementsContainer, svg);
        formatIsOK = true;
    } else if (validatePassword.value.length > 0 && !validateValidatePassword(validatePassword.value, document.querySelector('.passwordInput'))) {
        errorFormatInput(inputContainer, requirementsContainer, svg);
        validateAllInputs();
    }
}

function validate(inputElement) {
    let formatIsOK = false;
    let svg;
    if (inputElement.classList.contains('passwordInput')) {
        svg = inputElement.nextElementSibling.firstElementChild.firstElementChild.nextElementSibling.firstElementChild;
    } else {
        svg = inputElement.nextElementSibling.firstElementChild.firstElementChild;
    }
    const inputContainer = inputElement.parentNode;
    const requirementsContainer = inputElement.nextElementSibling.firstElementChild.nextElementSibling;
    
    // Si el input tiene length == 0 volver a su diseño por default
    if (inputElement.value.length == 0) {
        defaultFormatInput(inputElement, inputContainer, requirementsContainer, svg);
        if (inputElement.classList.contains('emailInput') && inputElement.hasAttribute('onkeyup')) {
            inputElement.removeAttribute('onkeyup');
            inputElement.setAttribute('onblur', 'fillInput(this)');
            svg.parentNode.classList.add('noPointerEvents');
        }
        if (inputElement.classList.contains('validatePasswordInput')) {
            svg.parentNode.classList.add('noPointerEvents');
        }
        return;
    }

    if (inputElement.classList.contains('emailInput')) {
        svg.parentNode.classList.remove('noPointerEvents');
        // Si ya ocurrió el evento onblur en emailInput, ahora cambiar  
        // la validación tras el evento onkeyup
        if (inputElement.classList.contains('emailInput') && inputElement.hasAttribute('onblur')) {
            inputElement.setAttribute('onblur', 'applyErrorFormatBlurInput(this)');
            inputElement.setAttribute('onkeyup', 'fillInput(this)');
        }
        if (validateEmail(inputElement.value)) {
            successFormatInput(inputElement, inputContainer, requirementsContainer, svg);
            formatIsOK = true;
        } else {
            errorFormatInput(inputContainer, requirementsContainer, svg);
            validateAllInputs();
        }
    } else if (inputElement.classList.contains('usernameInput')) {
        usernameReqIcons = [document.querySelector('.usernameReqIcon0'), document.querySelector('.usernameReqIcon1')];
        for (let i=0; i<usernameReqIcons.length; i++) {
            if (validateUsername(inputElement.value)[i+1]) {
                usernameReqIcons[i].setAttribute('href', './assets/icons/icons.svg#greenCheck-icon')
            } else {
                usernameReqIcons[i].setAttribute('href', './assets/icons/icons.svg#redCross-icon')
            }
        }
        if (validateUsername(inputElement.value)[0]) {
            successFormatInput(inputElement, inputContainer, requirementsContainer, svg);
            formatIsOK = true;
        } else {
            errorFormatInput(inputContainer, requirementsContainer, svg);
            validateAllInputs();
        }
    } else if (inputElement.classList.contains('passwordInput')) {
        passwordReqIcons = [document.querySelector('.passwordReqIcon0'), document.querySelector('.passwordReqIcon1'), document.querySelector('.passwordReqIcon2'), document.querySelector('.passwordReqIcon3'), document.querySelector('.passwordReqIcon4')];
        const validatePasswordInput = document.querySelector('.validatePasswordInput');
        dynamicValidatePassword(validatePasswordInput);

        for (let i=0; i<passwordReqIcons.length; i++) {
            if (validatePassword(inputElement.value)[i+1]) {
                passwordReqIcons[i].setAttribute('href', './assets/icons/icons.svg#greenCheck-icon')
            } else {
                passwordReqIcons[i].setAttribute('href', './assets/icons/icons.svg#redCross-icon')
            }
        }
        if (validatePassword(inputElement.value)[0]) {
            successFormatInput(inputElement, inputContainer, requirementsContainer, svg);
            formatIsOK = true;
        } else {
            errorFormatInput(inputContainer, requirementsContainer, svg);
            validateAllInputs();
        }
    } else if (inputElement.classList.contains('validatePasswordInput')) {
        svg.parentNode.classList.remove('noPointerEvents');
        if (validateValidatePassword(inputElement.value, document.querySelector('.passwordInput'))) {
            successFormatInput(inputElement, inputContainer, requirementsContainer, svg);
            formatIsOK = true;
        } else {
            errorFormatInput(inputContainer, requirementsContainer, svg);
            validateAllInputs();
        }
    } 

    return formatIsOK;
}

function applyErrorFormatBlurInput(inputElement) {
    let svg;
    if (inputElement.classList.contains('passwordInput')) {
        svg = inputElement.nextElementSibling.firstElementChild.firstElementChild.nextElementSibling.firstElementChild;
    } else {
        svg = inputElement.nextElementSibling.firstElementChild.firstElementChild;
    }
    const inputContainer = inputElement.parentNode;
    const requirementsContainer = inputElement.nextElementSibling.firstElementChild.nextElementSibling;

    if (inputElement.classList.contains('emailInput') || inputElement.classList.contains('usernameInput')) {
        inputElement.value = inputElement.value.trim();
    }

    if (!validate(inputElement)) {
        errorFormatBlurInput(inputElement, inputContainer, requirementsContainer, svg);
    }
}

// Función para abrir y cerrar requirimentsContainer clicando sobre el svg
let isDisplayed = false;
var displayedContainer;
function displayRequirements(e, svgElement) {
    e.stopPropagation();
    // if para incluír también al input de contraseña dado a que su estructura
    // es distinta a la de los demás 
    if (svgElement.classList.contains('exceptionForDisplay')) {
        displayedContainer = svgElement.parentNode.nextElementSibling;
    } else {
        displayedContainer = svgElement.nextElementSibling;
    }

    hideAllRequirements(displayedContainer);

    displayedContainer.classList.toggle('display');

    if (!displayedContainer.classList.contains('display')) {
        isDisplayed = true;
    } else {
        isDisplayed = false;
    }
}

// Esconder contenedor de requerimientos
function hideRequirements(inputElement) {
    const requirementsContainer = inputElement.nextElementSibling.firstElementChild.nextElementSibling;
    requirementsContainer.classList.remove('display');
}

function hideAllRequirements(displayedContainer) {
    document.querySelectorAll('.display').forEach(element => {
        if (displayedContainer != element) {
            if (element.classList.contains('display')) {
                element.classList.remove('display');
            }
        }
    });
}

// Funcionalidad dinámica para ver o no ver el icono de ojo para que da posibilidad
// a ver la contraseña
function displayEye(inputElement) {
    const eyeIcon = document.getElementById('eyeIcon');
    if (inputElement.value.length >= 0) {
        eyeIcon.setAttribute('href', './assets/icons/icons.svg#whiteClosedEye-icon');
    } 
}

const eyeIcon = document.getElementById('eyeIcon');
const passwordInput = document.getElementById('passwordInput');
function viewPassword() {
    passwordInput.focus();
    // Asegura que el cursor se mueva después del focus
    setTimeout(() => {
        const length = passwInput.value.length;
        passwInput.setSelectionRange(length, length);
    }, 0);

    const passwInput = document.querySelector('.passwordInput');
    if (passwInput.getAttribute('type') == "password") {
        passwInput.setAttribute('type', 'text');
        eyeIcon.setAttribute('href', `./assets/icons/icons.svg#${eyeColor}Eye-icon`)
    } else {
        passwInput.setAttribute('type', 'password');
        eyeIcon.setAttribute('href', `./assets/icons/icons.svg#${eyeColor}ClosedEye-icon`)
    }
}

// Cuando el usuario rellena el input se hace debounce para entrar a validate o a 
// displayEye en caso de que el input sea el de password 
function fillInput(inputElement) {
    clearTimeout(timeoutId);

    if (inputElement.classList.contains('emailInput') && !inputElement.hasAttribute('onkeyup')) {
        applyErrorFormatBlurInput(inputElement);
        inputElement.setAttribute('onblur', 'applyErrorFormatBlurInput(this)');
        inputElement.setAttribute('onkeyup', 'fillInput(this)');
    }

    if (inputElement.classList.contains('passwordInput') && document.getElementById('eyeIcon').getAttribute('href') == "") {
        timeoutId = setTimeout(() => displayEye(inputElement), 100);
    }

    timeoutId = setTimeout(() => validate(inputElement), 1200); 
}

function displayMessage(btnSubmit) {
    // El botón solo tiene el onclick="displayMessage(this)" si los campos 
    // todavía no han sido rellenados
    btnSubmit.style.disabled = "true";
    if (btnSubmit.getAttribute('type') == "button") {
        let errorSubmitMessage = document.querySelector('.errorSubmitMessage');

        errorSubmitMessage.firstElementChild.textContent = "Asegurate de completar todos los campos correctamente";
        errorSubmitMessage.style.animation = 'none';  // Resetea
        void errorSubmitMessage.offsetWidth; // Fuerza reflow
        errorSubmitMessage.style.animation = "appear 5s ease"; // Vuelve a aplicar
    }
}

let wasOnFocus = [false, null];
document.addEventListener('click', (e) => {
    let focusedInput = document.activeElement;
    let input;
    let inputContainer;

    if (focusedInput.hasAttribute('type') && focusedInput.tagName == "INPUT") {
        let focusedInput_container = focusedInput.parentNode.parentNode;
        let inputsList = ['emailInput', 'usernameInput', 'passwordInput', 'validatePasswordInput'];
        let inputContainersList = ['email-container', 'username-container', 'password-container', 'validatePassword-container'];
    
        input = inputsList.find(className => focusedInput.classList.contains(className));
        wasOnFocus = [true, document.querySelector(`.${input}`)];
        inputContainer = inputContainersList.find(className => focusedInput_container.classList.contains(className));
        
        // Evitar que el input se desenfoque si clicamos algun elemento dentro
        // de su contenedor
        if (document.querySelector(`.${inputContainer}`).contains(e.target)) {
            document.querySelector(`.${input}`).focus();
        }
        // Si el input estaba en focus pero ahora no
        if (wasOnFocus[0] && !wasOnFocus[1].matches(":focus")) {
            wasOnFocus = [false, null];
            applyErrorFormatBlurInput(document.querySelector(`.${input}`));
        }
    } else if (wasOnFocus[0] && !wasOnFocus[1].matches(":focus")) {
        applyErrorFormatBlurInput(wasOnFocus[1]);
        wasOnFocus = [false, null];
    }

    // Función para cerrar requirimentsContainer clicando fuera de él
    // Salir en caso de que la requirimentsContainer no esté en display
    // o en caso de que el usuario haya clicado sobre requirimentsContainer
    hideAllRequirements();

    if (!isDisplayed || displayedContainer.contains(e.target)) { 
        return;
    }
    displayedContainer.classList.remove('display');
    isDisplayed = false;
}) 

let intervalId;
let ejecutions = 0;
function closeModal(element) {
    const modal = element.parentNode.parentNode;

    clearInterval(intervalId);
    ejecutions = 0;

    const btnSubmit = document.getElementById('submitBtn');
    btnSubmit.style.disabled = "false";
    modal.style.display = "none";

    let confirmEmailHTML_loading = `<div class="confirmEmailModal_msgContainer_loading" id="confirmEmail-container">
                                        <svg class="loadingSvg">
                                            <use href="./assets/icons/icons.svg?v=1#loading-icon"></use>
                                        </svg>
                                    </div>`

    const confirmEmailModalContainer = document.querySelector('.confirmEmailModal');
    const confirmEmailContainer = document.getElementById('confirmEmail-container');
    confirmEmailContainer.remove();
    confirmEmailModalContainer.insertAdjacentHTML('beforeend', confirmEmailHTML_loading);
    if (confirmEmailContainer.classList.contains('confirmEmailModal_msgContainer')) {
        confirmEmailContainer.classList.remove('confirmEmailModal_msgContainer');
        confirmEmailContainer.classList.add('confirmEmailModal_msgContainer_loading');
    }

    // Esto es para resetear el estilo del modal y que no aparezca el mail anterior
    /* let modalReset = '<div class="subMainMsg-container"><div class="msg2"><span>📝Estamos escribiendo tu correo. Esto puede tardar unos segundos...</span></div></div><svg class="loadingSvg"><use href="./assets/icons/icons.svg?v=1#loading-icon"></use></svg>';
    const mainMsg_container = document.querySelector('.mainMsg-container');
    const confirmEmailModal_msgContainer = document.querySelector('.confirmEmailModal_msgContainer');

    while (mainMsg_container.firstChild) {
        mainMsg_container.firstChild.remove();
    }
    confirmEmailModal_msgContainer.lastChild.remove();

    mainMsg_container.insertAdjacentHTML('beforeend', modalReset); */
}

function resendEmail(btnResend) {
    btnResend.style.backgroundColor = "#E5E5E5";
    btnResend.style.color = "#ABABAB";
    btnResend.setAttribute('disabled', '');
    btnResend.removeAttribute('onclick');

    const form = document.querySelector('form');
    const formData = new FormData(form);
    let result;

    fetch('./scripts/signUp_validation.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        result = data;
    })
    .catch(error => {
        console.error('Error: ', error);
    })

    activeChronometer();
}

function activeChronometer() {
    let chronometer = document.querySelector('.seconds');
    chronometer.textContent = "30"; // Inicializamos al cronómetro en 30 segundos
    ejecutions = 0;

    intervalId = setInterval(function() {
        if (ejecutions === 30) {    // Si ya se ejecutó 30 veces significa que ya llegó a 0 segundos
            clearInterval(intervalId);
            return;
        }
        subtract(chronometer)       // Restar 1 segundo al valor de cronómetro actual
        ejecutions++;
    }, 1000);
}

function subtract(chronometer) {
    let value = parseInt(chronometer.textContent);
    value--;
    chronometer.textContent = value.toString();

    if (chronometer.textContent == "0") {
        const btnResend = document.querySelector('.btnResend');
        btnResend.style.backgroundColor = "#00BF63";
        btnResend.style.color = "#FFF";
        btnResend.removeAttribute('disabled');
        btnResend.setAttribute('onclick', 'resendEmail(this)');
    }
}

// Al enviar el formulario
document.getElementById('registerUser-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const confirmEmailModal = document.querySelector('.confirmEmailModal');
    const btnSubmit = document.getElementById('submitBtn');
    btnSubmit.style.disabled = "true";
    confirmEmailModal.style.display = "flex"; // Mostrar el modal si ocurrió el envío del email    
    
    const form = e.target;
    const formData = new FormData(form);
    let result;

    await fetch('./scripts/signUp_validation.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        result = data;
    })
    .catch(error => {
        console.error('Error: ', error);
    })

    if (result.inputError == 'username') {
        let inputContainer = document.querySelector('.usernameInput-container');
        let svg = document.getElementById('usernameSvg');
        inputContainer.style.borderBottom = "solid 2px #E72323";
        svg.setAttribute('href', './assets/icons/icons.svg#redError-icon');
        confirmEmailModal.style.display = "none";
    }
    if (!result.success) {
        let errorSubmitMessage = document.querySelector('.errorSubmitMessage');

        errorSubmitMessage.firstElementChild.textContent = `${result.message}`;
        errorSubmitMessage.style.animation = 'none';  // Resetea
        void errorSubmitMessage.offsetWidth; // Fuerza reflow
        errorSubmitMessage.style.animation = "appear 5s ease"; // Vuelve a aplicar
        return;
    } else {
        // Acá cambiamos el contenido del modal y le decimos al usuario que
        // revise su correo 
        let confirmEmailHTML =  `<div class="confirmEmailModal_msgContainer" id="confirmEmail-container">
                                    <div class="closeModal" onclick="closeModal(this)">
                                        <svg>
                                            <use href="./assets/icons/icons.svg?v=3#grayCross-icon"></use>
                                        </svg>
                                    </div>
                                    <h2>¡Tu historia en <span class="blueBold">Bookit</span> está por empezar!</h2>
                                    <hr> <!-- -------------------------------- -->
                                    <div class="mainMsg-container">
                                        <svg class="mailSentSvg">
                                            <use href="./assets/icons/icons.svg#mailSent-icon"></use>
                                        </svg>
                                        <div class="subMainMsg-container">
                                            <div class="msg1">
                                                <span>Acabamos de enviarte un correo a <span class="greenColorFont emailSentTo"></span></span>
                                            </div>
                                            <div class="msg2">
                                                <span>Revisá tu bandeja de entrada (y la de spam, por las dudas) y seguí las instrucciones.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottomOptions">
                                        <div class="subBottomOptions">
                                            <span>¿No te llegó?</span>
                                            <div class="btnResend-container">
                                                <span class="timeToResend"><span class="seconds">30</span>s</span>
                                                <button type="button" class="btnResend" disabled>Reenviar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
        const confirmEmailModalContainer = document.querySelector('.confirmEmailModal');
        const confirmEmailContainer = document.getElementById('confirmEmail-container');
        confirmEmailContainer.remove();
        confirmEmailModalContainer.insertAdjacentHTML('beforeend', confirmEmailHTML);
        if (confirmEmailContainer.classList.contains('confirmEmailModal_msgContainer_loading')) {
            confirmEmailContainer.classList.remove('confirmEmailModal_msgContainer_loading');
            confirmEmailContainer.classList.add('confirmEmailModal_msgContainer');
        }

        let confirmEmailModal = document.querySelector('.confirmEmailModal');
        const email = document.getElementById('emailInput').value;
        const emailSentTo = document.querySelector('.emailSentTo');

        emailSentTo.textContent = email;

        confirmEmailModal.style.display = "flex"; // Mostrar el modal si ocurrió el envío del email    
        
        activeChronometer();
}})


