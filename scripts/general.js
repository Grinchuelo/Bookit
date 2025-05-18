let dropdownIsActive = false;
let dropDown_container;
let options;

/* const dropDown_container = document.getElementById('dropdown-container');
const options = document.querySelector('.dropdown-options'); */

function dropdownOptions(dropdown) {
    dropDown_container = dropdown;
    options = dropDown_container.querySelector('.dropdown-options');
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

