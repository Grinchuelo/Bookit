<?php
session_start();
if (!isset($_SESSION['check'])) {
    $noAuth = true;
} 

if ($_POST) {
    $title = (isset($_POST['nombre_libro'])) ? $_POST['nombre_libro'] : "";
    $description = (isset($_POST['desc_libro'])) ? $_POST['desc_libro'] : "";
    $author = (isset($_POST['nombre_autor'])) ? $_POST['nombre_autor'] : "";
    $bookCover = (isset($_FILES['portada_libro']['name'])) ? $_FILES['portada_libro']['name'] : "";
    $price = (isset($_POST['precio_libro'])) ? $_POST['precio_libro'] : "";
    $publishDate = (isset($_POST['fecha_publicacion'])) ? $_POST['fecha_publicacion'] : "";
    
    // Establecer nombre de archivo de portada de libro unico para que no se sobreescriban
    $fecha = new DateTime();
    $nombreArchivo = ($bookCover != "") ? $fecha -> getTimestamp()."_".$_FILES['portada_libro']['name'] : "image.jpg";

    $tmpBookCover = $_FILES['portada_libro']['tmp_name'];
    if ($tmpBookCover != "") {
    move_uploaded_file($tmpBookCover, "../assets/bookCovers/".$nombreArchivo);
    }

    if (isset($_FILES['portada_libro'])) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        echo finfo_file($finfo, $_FILES['portada_libro']);
        finfo_close($finfo);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/generalAdmin.css">
    <link rel="stylesheet" href="./css/panels.css">
    <link rel="stylesheet" href="./css/agregar.css"> 
    <link rel="icon" href="../assets/icons/bookitLightIcon.ico" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.6.0"></script>


    <title>Administrador - Agregar libros</title>
</head>
<?php
if (isset($noAuth)) {
    include('./noAuthorization.php');
    die();
}
?>
<body>
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
            <form action="" enctype="multipart/form-data">
                <div class="input_label-container">
                    <label class="label_add" for="name">Título</label>
                    <input class="input_name" placeholder="Ingresa el título del libro" type="text" name="nombre_libro" id="name" required>
                </div>
                <div class="input_label-container">
                    <label class="label_add" for="desc">Descripción</label>
                    <textarea class="input_desc" placeholder="Ingresa la descripción del libro" type="text" name="desc_libro" id="desc" maxlength="500" required></textarea>
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
                        <input class="input_author" placeholder="Busca el nombre del autor" type="text" name="nombre_autor" id="autor_nombre" autocomplete="off" onkeyup="searchAuthors()" required>
                        <div class="coinc-container"></div>
                        <script src="../scripts/searchAuthors.js"></script>
                    </div>
                </div>
                <div class="bottom_form-container">
                    <div class="input_label-container bookCover-container">
                        <label for="bookCover-input" class="label_add">Portada</label>
                        <div class="addBookcover_input-container">
                            <img src="" alt="" id="bookCover-img">
                            <svg>
                                <use href="../assets/icons/icons.svg?v=3#image-icon"></use>
                            </svg>
                            <span class="txt">Selecciona un archivo</span>
                            <input type="file" name="portada_libro" id="bookCover-input" accept="image/*" onchange="previewImage(event)" required>
                        </div>
                    </div>
                    <div class="bottom_form_right-container">
                        <div class="input_label-container">
                            <label class="label_add" for="precio_libro">Precio <span class="instruction">($ARS)</span> </label>
                            <div class="priceInput-container">
                                <span class="price-icon">$</span>
                                <input class="input_price" type="text" name="precio_libro" id="precio_libro" min="0" max="1000000" required>
                            </div>
                        </div>
                        <?php 
                        date_default_timezone_set('America/Argentina/Cordoba');
                        $hoy = date("Y-m-d"); 
                        ?>
                        <div class="input_label-container">
                            <label for="fecha_publicacion" class="label_add">Fecha de publicación</label>
                            <input type="date" max="<?php echo $hoy; ?>" name="fecha_publicacion" id="fecha_publicacion" required>
                        </div>
                        <div class="submitForm_btn-container">
                            <span>Asegúrate de completar todos los campos</span>
                            <button type="submit">Agregar libro</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="title-container">
            <h1><span class="txt-green">Agrega</span> un nuevo libro al catálogo</h1>
        </div>  
    </main>

    <script src="../scripts/formatPriceInput.js"></script>
    <script src="../scripts/previewImage.js"></script>
    <!-- <script>
        let area = document.querySelector(".input_desc")
        
        area.addEventListener("input", () => {
            area.style.height = `${area.scrollHeight}px`;
        })    
    </script>  -->

    
</body>
</html>