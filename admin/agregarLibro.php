<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/generalAdmin.css">
    <link rel="stylesheet" href="./css/panels.css">
    <link rel="stylesheet" href="./css/agregar.css"> 
    <title>Administrador - Agregar libros</title>
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

    <main>
        <div class="forms-container">
            <form action="">
                <div class="input_label-container">
                    <label class="label_add" for="name">Título</label>
                    <input class="input_name" placeholder="Ingresa el título del libro" type="text" name="nombre_libro" id="name">
                </div>
                <div class="input_label-container">
                    <label class="label_add" for="desc">Descripción</label>
                    <textarea class="input_desc" placeholder="Ingresa la descripción del libro" type="text" name="desc_libro" id="desc" maxlength="500"></textarea>
                </div>
                <div class="input_label-container addAuthor-container">
                    <div class="biLabel">
                        <label class="label_add" for="autor_nombre">Autor</label>
                        <span class="instruction">¿No encuentra su autor? <span class="txt-bold">Añadir autor</span></span>
                    </div>
                    <div class="authorInput-container">
                        <svg>
                            <use href="../assets/icons/icons.svg?v=1#search-icon"></use>
                        </svg>
                        <input class="input_author" placeholder="Busca el nombre del autor" type="text" name="txtnombre_autor" id="autor_nombre" autocomplete="off" onkeyup="searchAuthors()">
                        <div class="coinc-container"></div>
                        <script src="../scripts/searchAuthors.js"></script>
                    </div>
                </div>
                <div class="bottom_form-container">
                    <div class="input_label-container bookCover-container">
                        <label for="bookCover-input" class="label_add">Portada</label>
                        <div class="addBookcover_input-container">
                            <svg>
                                <use href="../assets/icons/icons.svg?v=3#image-icon"></use>
                            </svg>
                            <span class="txt">Selecciona un archivo</span>
                            <input type="file" name="portada_libro" id="bookCover-input">
                        </div>
                    </div>
                    <div class="bottom_form_right-container">
                        <div class="input_label-container">
                            <label class="label_add" for="autor_nombre">Precio <span class="instruction">($ARS)</span> </label>
                            <div class="priceInput-container">
                                <span class="price-icon">$</span>
                                <input class="input_price" type="text" name="precio_libro" id="precio_libro" min="0" max="1000000">
                            </div>
                        </div>
                        <?php $hoy = date("Y-m-d"); ?>
                        <div class="input_label-container">
                            <label for="fecha_publicacion" class="label_add">Fecha de publicación</label>
                            <input type="date" max="<?php echo $hoy; ?>" name="fecha_publicacion" id="fecha_publicacion">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="title-container">
            <h1><span class="txt-green">Agrega</span> un nuevo libro al catálogo</h1>
        </div>  
    </main>

    <!-- <script>
        let area = document.querySelector(".input_desc")
        
        area.addEventListener("input", () => {
            area.style.height = `${area.scrollHeight}px`;
        })   
    </script> -->

    
</body>
</html>