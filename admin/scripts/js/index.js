document.querySelector('form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    let result;
    await fetch('./scripts/php/findAdmin.php', {
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

    const error_container = document.querySelector('.error-container');
    if (!result.success) {
        error_container.firstElementChild.textContent = result.message;
        error_container.style.display = "flex";
        error_container.style.animation = 'none';  // Resetea
        void error_container.offsetWidth; // Fuerza el reflow del navegador para que se pueda volver a aplicar la animación
        error_container.style.animation = "appear 5s ease"; // Vuelve a aplicar
        setTimeout(() => {
            error_container.style.display = "none";
        }, 5000)
    } else {
        location.href = './dashboard.php';
    }


})