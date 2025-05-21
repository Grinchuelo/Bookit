let dropdownIsActive = false;
let dropDown_container;
let options;

function getParameterByName(name) {
    return new URLSearchParams(window.location.search).get(name) || "";
}

// Sirve para hacer que todas las mini-ventanas tengan su logica compartida de open-close
function elementToShow(dropDown_container, displayNoneOptions) {
    for (let hijo of dropDown_container.children) {
        for(let className of displayNoneOptions) {
            if (hijo.classList.contains(`${className}`)) {
                return hijo;
            }
        }
    }
}

function dropdownOptions(e, dropdown) {
    e.stopPropagation();

    dropDown_container = dropdown;
    displayNoneOptions = ['dropdown-options', 'addToList-modal'];
    options = elementToShow(dropDown_container, displayNoneOptions);

    if (options.style.display == 'none') {
        options.style.display = 'flex';
        dropdownIsActive = true;
    } else {
        options.style.display = 'none';
        dropdownIsActive = false;
    }
}

document.addEventListener('click', (e) => {
    if (dropdownIsActive == false) {
        return;
    }
    else if (e.target != options && e.target != dropDown_container) {
        options.style.display = 'none';
        dropdownIsActive = false;
    }
})

