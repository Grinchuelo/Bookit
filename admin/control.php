<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/generalAdmin.css">
    <link rel="stylesheet" href="./css/panels.css">
    <title>Administración de libros</title>
</head>
<body>
    <?php
    include('../global/checkLogIn.php');
    var_dump($_SESSION);
    ?>
    <header>
        <a href="./dashboard.php">
            <svg class="backBtn">
                <use href="../assets/icons/icons.svg?v=2#backBtn-icon"></use>
            </svg>
        </a>
        <h2>LIBROS</h2>
        <a href="./logout.php">
            <svg>
                <use href="../assets/icons/icons.svg?v=2#logout-icon"></use>
            </svg>
        </a>
    </header>
    <menu>
        <input type="text" name="" id="" placeholder="Buscar un libro...">
        <div class="filters-btn">
            <p>Filtrar por</p> 
            <svg>
                <use href="../assets/icons/icons.svg?v=1#filter-icon"></use>
            </svg>
        </div>
    </menu>
    <main>
        <div class="lastAdded-container">
            <?php
            include('../config.php');
            $query = $conection->prepare("SELECT * FROM libros 
                                        INNER JOIN autores ON autores.id_autor = libros.autor_id
                                        ORDER BY libros.fecha_catalogo DESC;");
            $query->execute();
            $libros = $query->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h2>Últimos libros agregados</h2>
            <div class="list-container">
                <?php foreach ($libros as $libro) { ?>
                <div class="book-card">
                    <div class="bookCover-container">
                        <img src="../assets/bookCovers/<?php echo $libro['portada_libro'].".avif"; ?>" alt="Portada de <?php echo $libro['nombre_libro']; ?>">
                    </div>
                    <div class="info-container">
                        <div class="topInfo-container">
                            <span class="title"><?php echo $libro['nombre_libro']; ?></span>
                            <span class="author"><?php echo $libro['nombre_autor']; ?></span>
                            <span class="description"><?php echo $libro['desc_libro']; ?></span>
                        </div>
                        <div class="bottomInfo-container">
                            <div class="left">
                                <span class="price">$<?php echo $libro['precio_libro']; ?></span>
                                <div class="stars-container">
                                    <span class="stars"><?php echo $libro['stars_libro']; ?></span>
                                    <svg> 
                                        <use href="../assets/icons/icons.svg?v=1#star-icon"></use>
                                    </svg>
                                </div>
                            </div>
                            <div class="right">
                                <span class="date">
                                    <?php 
                                    setlocale(LC_TIME, 'es_ES', 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'es');
                                    echo strftime('%#d de %B de %Y', strtotime($libro['fecha_publicacion'])); 
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <?php $option = $_GET['option']; ?>
    <a href="
    <?php if($option=='libros') echo "./agregarLibro.php";
        else if ($option=='autores') echo "./agregarAutor.php";
        else if ($option=='sagas') echo "./agregarSaga.php"; ?>"
        class="addBook-btn">
            Agregar libro
    </a>

    <script src="../scripts/showHideBtn.js"></script>

</body>
</html>