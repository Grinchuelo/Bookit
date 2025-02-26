const btnAddBook = document.querySelector('.addBook-btn');

let scrollPos = 0;
window.addEventListener('scroll', function(){
    if ((document.body.getBoundingClientRect()).top > scrollPos) {
        // scroll up
        scrollPos = (document.body.getBoundingClientRect()).top;
        btnAddBook.classList.remove('hide');
        btnAddBook.classList.add('show');
    } else {
        // scroll down
        scrollPos = (document.body.getBoundingClientRect()).top;
        btnAddBook.classList.remove('show');
        btnAddBook.classList.add('hide');
    }
});