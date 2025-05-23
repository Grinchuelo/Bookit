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
  <?php 
  include('./config.php');

  include('./template/header.php') ?>
  <menu>
    <input type="text" name="" id="" placeholder="Buscar un libro...">
    <div class="dropdown-genres">
      Géneros
      <div class="genres-list">
        <div class="category">
          <h2>Ficción</h2>
          <ul>
            <?php foreach($generosFic as $genero) { ?>
              <li><?php echo $genero['genero']; ?></li>
            <?php } ?>
          </ul>
        </div>
        <div class="category">
          <h2>No ficción</h2>
          <ul>
            <?php foreach($generosNFic as $genero) { ?>
              <li><?php echo $genero['genero']; ?></li>
            <?php } ?>
          </ul>
        </div>
        <div class="category">
          <h2>Especializados</h2>
          <ul>
            <?php foreach($generosEsp as $genero) { ?>
              <li><?php echo $genero['genero']; ?></li>
            <?php } ?>
          </ul>
        </div>
        <div class="category">
          <h2>Juvenil e Infantil</h2>
          <ul>
            <?php foreach($generosJEI as $genero) { ?>
              <li><?php echo $genero['genero']; ?></li>
            <?php } ?>
          </ul>
        </div>
          
      </div>
    </div>
    
  </menu>
  <main>
    <?php
    $query = $conection->prepare("SELECT * FROM libros ORDER BY vecesBuscado DESC LIMIT 45;");
    $query->execute();
    $masBuscados = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="category-slide most-searched">
      <h2>Más buscados</h2>
            <!--AGREGAR SÓLO EN VISTA DE PC-->
      <!-- <button class="scroll-btn left-btn">
        <svg>
          <use href="./assets/icons/icons.svg#arrowLeft-icon"></use>
        </svg>
      </button>
      <button class="scroll-btn right-btn">
        <svg>
          <use href="./assets/icons/icons.svg#arrowRight-icon"></use>
        </svg>
      </button> -->
      <div class="slide-container">
        <?php
        foreach ($masBuscados as $libro) {
        ?>
        <a href="libro.php?id_libro=<?php echo $libro['id_libro'] ?>" class="card">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/<?php echo $libro['portada_libro'];?>.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="<?php echo $libro['nombre_libro']; ?>">
              <h3><?php echo $libro['nombre_libro']; ?></h3>
            </div> 
            <div class="priceAndStars-container">
              <div class="priceCard">
              $<?php echo $libro['precio_libro']; ?>
              </div>
              <div class="starsCard">
                <?php echo $libro['stars_libro']; ?>
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </a>
        <?php } ?>
        </div>
      </div>
    </div>
    <?php
    $query = $conection->prepare("SELECT * FROM libros ORDER BY stars_libro DESC LIMIT 45;");
    $query->execute();
    $masLikeados = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="category-slide most-liked">
      <h2>Más gustados</h2>
            <!--AGREGAR SÓLO EN VISTA DE PC-->
      <!-- <button class="scroll-btn left-btn">
        <svg>
          <use href="./assets/icons/icons.svg#arrowLeft-icon"></use>
        </svg>
      </button>
      <button class="scroll-btn right-btn">
        <svg>
          <use href="./assets/icons/icons.svg#arrowRight-icon"></use>
        </svg>
      </button> -->
      <div class="slide-container">
        <?php
        foreach ($masLikeados as $libro) {
        ?>
        <div class="card">
          <div class="bookCover-container">
            <img src="https://bookit-assets.s3.us-east-2.amazonaws.com/bookCovers/<?php echo $libro['portada_libro']; ?>.avif" alt="">
          </div>
          <div class="info-container">
            <div class="title-container" title="<?php echo $libro['nombre_libro']; ?>">
              <h3><?php echo $libro['nombre_libro']; ?></h3>
            </div> 
            <div class="priceAndStars-container">
              <div class="priceCard">
              $<?php echo $libro['precio_libro']; ?>
              </div>
              <div class="starsCard">
                <?php echo $libro['stars_libro']; ?>
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg> 
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        </div>
      </div>
    </div>
            <!--AGREGAR SÓLO EN VISTA DE PC-->
      <!-- <button class="scroll-btn left-btn">
        <svg>
          <use href="./assets/icons/icons.svg#arrowLeft-icon"></use>
        </svg>
      </button>
      <button class="scroll-btn right-btn">
        <svg>
          <use href="./assets/icons/icons.svg#arrowRight-icon"></use>
        </svg>
      </button> -->
      
  </main>

  <script src="./scripts/general.js"></script>
<?php include('./template/footer.php'); ?>