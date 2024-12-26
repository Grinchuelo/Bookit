let btnDropdownGenres = document.querySelector('.dropdown-genres');
let genresList = document.querySelector('.genres-list');

console.log("asdasd")
btnDropdownGenres.addEventListener('click', () => {
    genresList.classList.toggle('flex');
})