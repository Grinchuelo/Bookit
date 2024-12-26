<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/home.css">
  <link rel="stylesheet" href="./css/general.css">
  <title>Bookit</title>
</head>

<?php 
include('./conection.php'); 

$query = $conection->prepare("SELECT * FROM generos WHERE categoria_genero = 'fic'");
$query->execute();
$generosFic = $query->fetchAll(PDO::FETCH_ASSOC);
$query = $conection->prepare("SELECT * FROM generos WHERE categoria_genero = 'nfic'");
$query->execute();
$generosNFic = $query->fetchAll(PDO::FETCH_ASSOC);
$query = $conection->prepare("SELECT * FROM generos WHERE categoria_genero = 'esp'");
$query->execute();
$generosEsp = $query->fetchAll(PDO::FETCH_ASSOC);
$query = $conection->prepare("SELECT * FROM generos WHERE categoria_genero = 'jei'");
$query->execute();
$generosJEI = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<body>
  <?php include('./template/header.php') ?>
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
    <div class="category-slide most-searched">
      <h2>Más buscados</h2>
      <div class="slide-container">
        <div class="card">
          <div class="bookCover-container">
            <img src="./assets/bookCovers/Cien_años_de_soledad.png" alt="">
          </div>
          <div class="info-container">
            <div class="tags-container">
              <div class="tag">
                Realismo M
              </div>
            </div>
            <div class="priceAndStars-container">
              <div class="priceCard">
                $28900
              </div>
              <div class="starsCard">
                4.7
                <svg>
                  <use href="./assets/icons/icons.svg#star-icon"></use>
                </svg>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="bookCover-container">
            <img src="./assets/bookCovers/la_cancion_de_aquiles.jpg" alt="">
          </div>
          <div class="info-container">
            <div class="tags-container">
              <div class="tag">
                Realismo
              </div>
            </div>
            <div class="priceAndStars-container">
              <div class="priceCard">
                $28900
              </div>
              <div class="starsCard">
                4.7
                <img src="./assets/icons/Star.png" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="bookCover-container">
            <img src="./assets/bookCovers/la_cancion_de_aquiles.jpg" alt="">
          </div>
          <div class="info-container">
            <div class="tags-container">
              <div class="tag">
                Realismo
              </div>
            </div>
            <div class="priceAndStars-container">
              <div class="priceCard">
                $28900
              </div>
              <div class="starsCard">
                4.7
                <img src="./assets/icons/Star.png" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="bookCover-container">
            <img src="./assets/bookCovers/la_cancion_de_aquiles.jpg" alt="">
          </div>
          <div class="info-container">
            <div class="tags-container">
              <div class="tag">
                Realismo
              </div>
            </div>
            <div class="priceAndStars-container">
              <div class="priceCard">
                $28900
              </div>
              <div class="starsCard">
                4.7
                <img src="./assets/icons/Star.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="./scripts/index.js"></script>
</body>

</html>