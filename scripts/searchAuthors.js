let timeoutId;

function filter() {
    var query = document.querySelector('.input_author').value; // obtener el texto escrito
    var coinc_container = document.querySelector('.coinc-container'); // contenedor donde mostrar las sugerencias
    
    // Limpiar las sugerencias previas
    coinc_container.innerHTML = '';

    // Si el usuario no ha escrito al menos 2 caracteres, salir
    if (query.length < 2) return; // por ejemplo, solo buscar después de 2 caracteres ingresados

    let authors = [];

    fetch('getAuthors.php')
    .then(response => {
        return response.text(); // Convertir la respuesta a texto
    })
    .then(text => {
        /* console.log("Respuesta del servidor:", text); */  // Muestra lo que el servidor está enviando
        authors = JSON.parse(text); // Convertir el texto a JSON
    })
    .then(() => {
        // Filtrar autores que coincidan con el término de búsqueda
        var filteredAuthors = authors.filter(function(author) {
            return author.nombre_autor.toLowerCase().includes(query.toLowerCase());
        });

        // Mostrar las sugerencias
        filteredAuthors.forEach(function(author) {
            console.log(author);
            var div = document.createElement('div');
            div.textContent = author.nombre_autor; // Mostrar el nombre del autor
            div.onclick = function() {
                document.querySelector('.input_author').value = author.nombre_autor; // completar el campo con el autor seleccionado
                coinc_container.style.display = 'none';
                coinc_container.innerHTML = ''; // limpiar las sugerencias
            };
            coinc_container.appendChild(div);
            coinc_container.style.display = 'flex';
        });
    })
    .catch(error => console.error('Error al cargar los autores:', error));

    if (query.length == 0) coinc_container.style.display = 'none';
}

function searchAuthors() {
    clearTimeout(timeoutId); // Clear the previous timeout
    timeoutId = setTimeout(filter, 300); // Set a new timeout
}