const bookContainer = document.querySelector('.book-container');
const alikeBooksContainer = document.querySelector('.alikeBooks-container');
/* const alikeBooksList = document.querySelector('.alikeBooks-subContainer'); */
const alikeBooksTitle = document.querySelector('.alikeBooksTitle');

function verifyWrap() {
    if (alikeBooksContainer.offsetTop == bookContainer.offsetTop) {
        bookContainer.classList.add('book_sticky');
        alikeBooksContainer.classList.add('alikeBooks_sticky');
        alikeBooksTitle.classList.add('alikeBooksTitle_sticky');
    } else {
        bookContainer.classList.remove('book_sticky');
        alikeBooksContainer.classList.remove('alikeBooks_sticky');
        alikeBooksTitle.classList.remove('alikeBooksTitle_sticky');
    }
}

window.addEventListener('load', verifyWrap);
window.addEventListener('resize', verifyWrap);

let timeOutId;
function makeAppear(message) {
    clearTimeout(timeOutId);
    message.style.display = "flex";
    message.style.animation = 'none';  // Resetea
    void message.offsetWidth; // Fuerza el reflow del navegador para que se pueda volver a aplicar la animación
    message.style.animation = "appear 5s ease"; // Vuelve a aplicar
    timeOutId = setTimeout(() => {
        message.style.display = "none";
    }, 5000)
}

function appearMessage() {
    let message = document.querySelector('.nonLoginNotice');
    makeAppear(message);
}

function elementToShow(dropDown_container, displayNoneOptions) {
    for (let hijo of dropDown_container.children) {
        for(let className of displayNoneOptions) {
            if (hijo.classList.contains(`${className}`)) {
                return hijo;
            }
        }
    }
}

function libroDropdownOptions(e, dropdown) {
    e.stopPropagation();

    dropDown_container = dropdown;
    displayNoneOptions = ['addToList-modal'];
    options = elementToShow(dropDown_container, displayNoneOptions);

    if (options.style.display == 'none') {
        options.style.display = 'flex';
        dropdownIsActive = true;
    } else {
        options.style.display = 'none';
        dropdownIsActive = false;
    }
}

function getParameterByName(name) {
    return new URLSearchParams(window.location.search).get(name) || "";
}

async function addToList(booksList_element) {
    let id_book = getParameterByName("id_libro");
    let id_saga = getParameterByName("id_saga");
    const listName = booksList_element.getAttribute('listName');

    let id = id_book != "" ? id_book : id_saga;
    let parameter;
    
    if (id_book != "") {
        parameter = "id_libro"; 
    } else {
        parameter = "id_saga"; 
    }

    let result;

    await fetch (`./scripts/addToList.php?${parameter}=${id}&listName=${encodeURIComponent(listName)}`)
    .then(response => response.json())
    .then(data => {
        result = data;
    })
    .catch(error => {
        console.error('Error: ', error);
    })

    if (result.reason == 'wrongData') {
        const errorAddingToList = document.querySelector('.errorAddingToList');
        errorAddingToList.firstElementChild.textContent = result.message;
        makeAppear(errorAddingToList);
    }

    console.log(result.message);
}

function allowStar() {
    console.log("SIII");
}