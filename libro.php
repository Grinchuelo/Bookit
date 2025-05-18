<?php
include('./config.php');

if (isset($_SESSION['isAdmin'])) {
    if ($_SESSION['isAdmin'] == true) {
        $_SESSION = array();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="icon" href="./assets/icons/bookitIcon.ico" type="image/x-icon">
    <title>Bookit</title>
</head>
<body>
  <?php include('./template/header.php') ?>
  <?php
  $id_libro = $_GET['id_libro'];
  $query = $conection->prepare("SELECT * FROM libros WHERE id_libro = :id_libro");
  $query->bindParam(':id_libro', $id_libro);
  $query->execute();
  $libro = $query->fetch(PDO::FETCH_LAZY);

  $query = $conection->prepare("SELECT * FROM autores INNER JOIN libros ON libros.autor_id = autores.id_autor WHERE libros.id_libro = 1;");
  $query->execute();
  $autor = $query->fetch(PDO::FETCH_LAZY);

  $query = $conection->prepare("SELECT * FROM generos INNER JOIN libros_generos ON generos.id_genero = libros_generos.genero_id WHERE libros_generos.libro_id = :id_libro;");
  $query->bindParam(':id_libro', $id_libro);
  $query->execute();
  $generos = $query->fetchAll(PDO::FETCH_ASSOC);

  /* $query = $conection->prepare("SELECT * FROM librosdeseados WHERE libro_id = :id_libro;");
  $query->bindParam(':id_libro', $id_libro);
  $query->execute();
  $librosDeseados = $query->fetchAll(PDO::FETCH_ASSOC); */
  ?>
  <main class="libroMain-container">
    <div class="book-container">
      <div class="book-data">
        <div class="book-data-first">
          <div class="img-container">
            <img src="./assets/bookCovers/<?php echo $libro['portada_libro']; ?>.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container">
              <h1><?php echo $libro['nombre_libro'] ?></h1>
            </div>
            <a href="autor.php?id_autor=<?php echo $autor['id_autor']; ?>" class="autor-container">
              <img src="./assets/rowling.jpg" alt="">
              <?php echo $autor['nombre_autor']; ?>
            </a>
            <div class="tags-container">
              <?php foreach($generos as $genero) { ?>
              <div class="tag">
                <?php echo $genero['genero']; ?>
              </div>
              <?php } ?>
            </div>
            <div class="book-data-sec">
              <data class="price">$<?php echo $libro['precio_libro']; ?></data>
              <div class="stars-container">
                <data class="stars">
                  4.5
                </data>
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg>
              </div>
            </div>
          </div>
        </div>
        <div class="description-container">
          <p><?php echo $libro['desc_libro']; ?></p>
        </div>
        <?php
        /* if(count($librosDeseados) >= 2) {
        ?>
        <div class="book-data-third">
          <data value="<?php echo count($librosDeseados); ?>"><?php echo count($librosDeseados); ?> usuarios quieren este libro</data>
        </div>
        <?php } */ ?>
      </div>
      <div class="buttons">
        <div href="" class="pdf-button">
          <svg>
            <use href="./assets/icons/icons.svg#pdf-icon"></use>
          </svg>
          <div class="button-desc-container">
            <span class="button-desc">Obtener <b>PDF</b></span>
          </div>
        </div>
        <div href="" class="addToList-button">
          <div class="addToList-modal">
            <div class="top">
              <div class="title">
                <h2>Guardar</h2>
              </div>
              <div class="wished">
                <div class="left">
                  <div class="listPicture-container">
                    <svg>
                      <use href="./assets/icons/icons.svg#bookmark-icon"></use>
                    </svg>
                  </div>
                  <span class="listName">Deseados</span>
                </div>
                <div class="right">
                  <span>Guardado</span>
                </div>
              </div>
            </div>
            <div class="bottom">
              <svg>
                <use href="./assets/icons/icons.svg?v=2#grayCreateList-icon"></use>
              </svg>
              <span>Crear lista</span>
            </div>
          </div>
          <svg>
            <use href="./assets/icons/icons.svg?v=1#addToList-icon"></use>
          </svg>
          <div class="button-desc-container">
            <span class="button-desc">Añadir a una lista</span>
          </div>
        </div>
      </div>
    </div>
    <div class="alikeBooks-container">
      <h2 class="alikeBooksTitle">Me recuerdan a <b>Harry Potter Y La Orden Del Fénix</b></h2>
      <div class="alikeBooks-subContainer">
        <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      <a href="libro.php?id_libro=3" class="libroCard">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/harryPotterYLaCamaraSecreta.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="Harry Potter y la Cámara Secreta">
              <h3>Harry Potter y la Cámara Secreta</h3>
            </div> 
            <span class="libroAuthor">J. K. Rowlgfgfh  dffdhgf ing</span>
            <div class="priceAndStars-container">
              <div class="priceCard">
              $29999
              </div>
              <div class="starsCard">
                4.8
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </main>

  <script src="./scripts/libro.js" defer></script>
  <script src="./scripts/general.js" defer></script>
<?php include('./template/footer.php'); ?>