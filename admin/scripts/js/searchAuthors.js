let timeoutId;

const coinc_container = document.querySelector('.coinc-container');

function filter() {
    let query = (document.querySelector('.input_author').value).trim();

    if (query.length < 2) {
        coinc_container.style.display = "none";
        return;
    } else if (query.length >= 2) {
        fetch(`./scripts/php/getAuthors.php?query=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => {
            displayResults(data);
        })
        .catch(error => console.error('Error:', error));
    } else {
        displayResults([]);
    }
}

function displayResults(results) {
    coinc_container.innerHTML = '';

    if (results.length == 0) {
        let newDiv = document.createElement("div");
        newDiv.textContent = "No se encontró este autor";
        coinc_container.appendChild(newDiv);
        coinc_container.style.display = "flex";
        return;
    }

    results.forEach(author => {
        let newAuthor = document.createElement("div");
        newAuthor.textContent = author.nombre_autor;
        coinc_container.appendChild(newAuthor);
    });
    coinc_container.style.display = "flex";

    let displayedAuthors = coinc_container.childNodes;

    displayedAuthors.forEach(author => {
        author.addEventListener('click', () => {
            document.querySelector('.input_author').value = author.textContent;
            coinc_container.style.display = "none";
        })
    })
}

function searchAuthors() {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(filter, 300); 
}