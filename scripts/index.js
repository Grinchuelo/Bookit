let timeoutId;
let charsAllowedUsername = /^[a-zA-Z0-9_]*$/;

function validate(inputElement) {
    const inputContainer = inputElement.parentNode;
    const requirementsContainer = inputElement.nextElementSibling.firstElementChild.nextElementSibling;
    const svg = inputElement.nextElementSibling.firstElementChild.firstElementChild;

    if (inputElement.classList.contains('usernameInput')) {
        validateUsername(inputElement, inputContainer, requirementsContainer, svg);
    }
    if (inputElement.classList.contains('emailInput')) {
        validateEmail(inputElement, inputContainer, requirementsContainer, svg);
    }
}

function validateUsername(inputElement, inputContainer, requirementsContainer, svg) {
    // formato de nombre de usuario CORRECTO
    if (inputElement.value.length == 0 || inputElement.value.length >= 3 && charsAllowedUsername.test(inputElement.value)) {
        if (inputElement.value.length >= 3 && charsAllowedUsername.test(inputElement.value)) {
            svg.setAttribute('href', './assets/icons/icons.svg#roundedGreenCheck-icon');
        }
        if (inputElement.value.length == 0 && inputElement.classList.contains('noValidateIcon')) {
            svg.setAttribute('href', '');            
        } else if (inputElement.value.length == 0) {
            svg.setAttribute('href', './assets/icons/icons.svg#info-icon');   
        }
        successFormatInput(inputElement, inputContainer, requirementsContainer);
        return
    }
    // formato de nombre de usuario INCORRECTO
    if (inputElement.value.length < 3 || !charsAllowedUsername.test(inputElement.value)) {
        errorFormatInput(inputContainer, requirementsContainer, svg)
        return;
    } 
}

function validateEmail(inputElement, inputContainer, requirementsContainer, svg) {
    inputElement.setAttribute('onkeyup', 'validateEmail(this)');
    const formatEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (formatEmail.test(inputElement.value)) {
        successFormatInput(inputElement, inputContainer, requirementsContainer)
    } else {
        errorFormatInput(inputContainer, requirementsContainer, svg)
        errorFormatBlurInput(inputElement);
    }
}
// Cuando el usuario rellena el input se hace debounce para entrar a validate o a 
// displayEye en caso de que el input sea el de password 
function fillInput(inputElement) {
    clearTimeout(timeoutId);
    if (inputElement.getAttribute('id') == "passwordInput") {
        timeoutId = setTimeout(() => displayEye(inputElement), 100); 
    }

    timeoutId = setTimeout(() => validate(inputElement), 1200); 
}

function hideRequirements(inputElement) {
    const requirementsContainer = inputElement.nextElementSibling.firstElementChild.nextElementSibling;
    requirementsContainer.style.display = "none";

    if ((inputElement.value.length < 3 && inputElement.value.length > 0) || !charsAllowedUsername.test(inputElement.value)) {
        errorFormatBlurInput(inputElement);
    }
}

// Funcionalidad dinámica para ver o no ver el contenido de la contraseña
function displayEye(inputElement) {
    const eyeIcon = document.getElementById('eyeIcon');
    if (inputElement.value.length >= 0) {
        eyeIcon.setAttribute('href', './assets/icons/icons.svg#blueClosedEye-icon');
    } if (inputElement.value.length == 0) {
        eyeIcon.setAttribute('href', '');
    }
}

const eyeIcon = document.getElementById('eyeIcon');
const passwordInput = document.getElementById('passwordInput');
eyeIcon.addEventListener('click', () => {
    passwordInput.focus();
    eyeIcon.setAttribute('href', './assets/icons/icons.svg#blueEye-icon');
    passwordInput.setAttribute('type', 'text');
})

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
    displayedContainer.classList.toggle('display');

    if (displayedContainer.classList.contains('display')) {
        isDisplayed = true;
    }
}

function successFormatInput(inputElement, inputContainer, requirementsContainer) {
    inputContainer.style.borderBottom = "solid 1px #fff";
    inputContainer.style.borderRadius = "0px";
    inputContainer.style.backgroundColor = "transparent";
    inputElement.style.color = "#fff";
    inputElement.classList.remove("placeholderBlue");
    inputElement.classList.add("placeholderWhite");
    requirementsContainer.style.display = "none";
}

function errorFormatInput(inputContainer, requirementsContainer, svg) {
    svg.setAttribute('href', './assets/icons/icons.svg#redError-icon');
    inputContainer.style.borderBottom = "solid 2px #E72323";
    requirementsContainer.style.display = "block";
}
// En caso de que el usuario blurree el input sobre el que escribió
function errorFormatBlurInput(inputElement) {
    const inputContainer = inputElement.parentNode;

    inputContainer.style.borderRadius = "1rem";
    inputContainer.style.backgroundColor = "#FFE2E2";
    inputElement.style.color = "#3783F5";
    inputElement.classList.add("placeholderBlue");
}

// Función para cerrar requirimentsContainer clicando fuera de él
document.addEventListener('click', (e) => {
    // Salir en caso de que la requirimentsContainer no esté en display
    // o en caso de que el usuario haya clicado sobre requirimentsContainer
    if (!isDisplayed || displayedContainer.contains(e.target)) return;
    
    displayedContainer.classList.remove('display');
    isDisplayed = false;
})
