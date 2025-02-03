let btnDropdownGenres = document.querySelector('.dropdown-genres');
let genresList = document.querySelector('.genres-list');

btnDropdownGenres.addEventListener('click', () => {
    genresList.classList.toggle('flex');
})