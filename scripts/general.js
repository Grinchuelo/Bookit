function dropdownOptions(dropdownElement) {
    const options = dropdownElement.firstElementChild.nextElementSibling;
    if (options.style.display == 'none') {
        options.style.display = 'flex';
    } else {
        options.style.display = 'none';
    }
}

