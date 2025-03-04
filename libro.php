<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <title>Bookit</title>
</head>
<body>
  <?php include('./template/header.php') ?>
  <?php
  include('./config.php');
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

  $query = $conection->prepare("SELECT * FROM librosdeseados WHERE libro_id = :id_libro;");
  $query->bindParam(':id_libro', $id_libro);
  $query->execute();
  $librosDeseados = $query->fetchAll(PDO::FETCH_ASSOC);
  ?>
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
            <?php echo $autor['nombre_autor']; ?>
          </a>
          <div class="tags-container">
            <?php foreach($generos as $genero) { ?>
            <div class="tag">
              <?php echo $genero['genero']; ?>
            </div>
            <?php } ?>
            <!-- <div class="tag">
              Cocina y Gastronomía
            </div>
            <div class="tag">
              Cocina y Gastronomía
            </div> -->
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
      if(count($librosDeseados) >= 2) {
      ?>
      <div class="book-data-third">
        <data value="<?php echo count($librosDeseados); ?>"><?php echo count($librosDeseados); ?> usuarios quieren este libro</data>
      </div>
      <?php } ?>
    </div>
    <div class="buttons">
      <a href="" class="pdf-button">
        <svg>
          <use href="./assets/icons/icons.svg#pdf-icon"></use>
        </svg>
        <div class="button-desc-container">
          <span class="button-desc">Obtener <b>PDF</b></span>
        </div>
      </a>
      <a href="" class="wishList-button">
        <div class="button-desc-container">
          <span class="button-desc">Añadir a tu lista de deseados</span>
        </div>
        <svg>
          <use href="./assets/icons/icons.svg#bookmark-icon"></use>
        </svg>
      </a>
    </div>
  </div>
  <?php include('./template/footer.php'); ?>