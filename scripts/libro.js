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