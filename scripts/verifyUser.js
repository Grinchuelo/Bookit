function msgAppear(msgContainer, result) {
    msgContainer.firstElementChild.textContent = result.message;
    msgContainer.style.animation = 'none';  // Resetea
    void msgContainer.offsetWidth; // Fuerza el reflow del navegador para que se pueda volver a aplicar la animación
    msgContainer.style.animation = "appear 5s ease"; // Vuelve a aplicar
}

/* function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
} */
function getParameterByName(name) {
    return new URLSearchParams(window.location.search).get(name) || "";
}

document.querySelector('form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    let result;

    let token = getParameterByName('token');
    await fetch(('./scripts/verifyUser.php?token=' + token), {
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

    const msgContainer = document.getElementById('msg-container');
    if (result.success == false) {
        if (msgContainer.classList.contains('successMsg-container')) {
            msgContainer.classList.remove('successMsg-container');
        }
        msgAppear(msgContainer, result);
    } else {
        msgContainer.classList.add('successMsg-container');
        msgAppear(msgContainer, result);

        setTimeout(() => {
            window.location.href = './home.php';
        }, 1000)
    }
})