const errorMsgContainer = document.getElementById('errorMsg-container');

function displayErrorMsg(errorMsg) {
    errorMsgContainer.firstElementChild.textContent = errorMsg;
    errorMsgContainer.style.animation = 'none';  // Resetea
    void errorMsgContainer.offsetWidth; // Fuerza el reflow del navegador para que se pueda volver a aplicar la animación
    errorMsgContainer.style.animation = "appear 5s ease"; // Vuelve a aplicar
}

function viewPassword() {
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.getElementById('eyeIcon');

    passwordInput.focus();
    // Asegura que el cursor se mueva después del focus
    setTimeout(() => {
        const length = passwordInput.value.length;
        passwordInput.setSelectionRange(length, length);
    }, 0);

    if (passwordInput.getAttribute('type') == "password") {
        passwordInput.setAttribute('type', 'text');
        eyeIcon.firstElementChild.setAttribute('href', `./assets/icons/icons.svg#whiteEye-icon`)
    } else {
        passwordInput.setAttribute('type', 'password');
        eyeIcon.firstElementChild.setAttribute('href', `./assets/icons/icons.svg#whiteClosedEye-icon`)
    }
}

document.querySelector('form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    let result;

    await fetch('./scripts/findUser.php', {
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

    if (!result.success) {
        displayErrorMsg(result.message);
    } else {
        location.href = './home.php';
    }
})