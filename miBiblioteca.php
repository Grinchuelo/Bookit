<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="icon" href="./assets/icons/bookitIcon.ico" type="image/x-icon">
    <title>Mi biblioteca • Bookit</title>
</head>
<body>
    <?php include('./template/header.php'); ?>
    <main class="libraryMain-container">
        <h1>Biblioteca</h1>
        <nav>
            <ul>
                <li class="navElement-selected">MIS LIBROS</li>
                <li>DESEADOS</li>
                <li>LISTAS</li>
            </ul>
        </nav>
        <div class="cards-container">
            <div class="cardsList">
                <div class="bookCard">
                    <img src="./assets/bookCovers/harryPotterYLaOrdenDelFenix.avif" alt="">
                    <div class="bookData">
                        <h2>Harry Potter y La Orden del Fenix</h2>
                        <div class="author">
                            <img src="./assets//bookCovers/rowling.jpg" alt="">
                            <span>J. K. Rowling</span>
                        </div>
                        <span class="description">
                            A lo largo de siete generaciones, los Buendía enfrentan amores prohibidos, guerras, soledad y destino en el mágico pueblo de Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam, est.
                        </span>
                        <div class="bottomCard">
                            <div class="stars">
                                <span>4.7</span>
                                <svg>
                                    <use href="./assets/icons/icons.svg#star-icon"></use>
                                </svg>
                            </div>
                            <div class="yourCalification">
                                <span>Calificar</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bookCard">
                    <img src="./assets/bookCovers/harryPotterYLaOrdenDelFenix.avif" alt="">
                    <div class="bookData">
                        <h2>Harry Potter y La Orden del Fenix</h2>
                        <div class="author">
                            <img src="./assets//bookCovers/rowling.jpg" alt="">
                            <span>J. K. Rowling</span>
                        </div>
                        <span class="description">
                            A lo largo de siete generaciones, los Buendía enfrentan amores prohibidos, guerras, soledad y destino en el mágico pueblo de Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam, est.
                        </span>
                        <div class="bottomCard">
                            <div class="stars">
                                <span>4.7</span>
                                <svg>
                                    <use href="./assets/icons/icons.svg#star-icon"></use>
                                </svg>
                            </div>
                            <div class="yourCalification">
                                <span>Calificar</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bookCard">
                    <img src="./assets/bookCovers/harryPotterYLaOrdenDelFenix.avif" alt="">
                    <div class="bookData">
                        <h2>Harry Potter y La Orden del Fenix</h2>
                        <div class="author">
                            <img src="./assets//bookCovers/rowling.jpg" alt="">
                            <span>J. K. Rowling</span>
                        </div>
                        <span class="description">
                            A lo largo de siete generaciones, los Buendía enfrentan amores prohibidos, guerras, soledad y destino en el mágico pueblo de Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam, est.
                        </span>
                        <div class="bottomCard">
                            <div class="stars">
                                <span>4.7</span>
                                <svg>
                                    <use href="./assets/icons/icons.svg#star-icon"></use>
                                </svg>
                            </div>
                            <div class="yourCalification">
                                <span>Calificar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('./template/footer.php'); ?>
</body>
</html>