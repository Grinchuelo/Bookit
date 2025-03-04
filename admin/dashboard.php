<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/generalAdmin.css">
    <title>Panel de administrador</title>
</head>
<body>
    <?php
    include('../global/checkLogIn.php');
    var_dump($_SESSION);
    ?>
    <header>
        <a href="./logout.php">
            <svg>
                <use href="../assets/icons/icons.svg#logout-icon"></use>
            </svg>
        </a>
    </header>
    <main>
        <h2>Panel de administrador</h2>
        <p>
            En este panel puede <span class="txt-green">agregar</span>, <span class="txt-yellow">editar</span>, <span class="txt-red">eliminar</span> o tan sólo inspeccionar 
            cualquier libro, saga o autor en Bookit.
        </p>
        <div class="admin-options">
            <a href="./control.php?option=libros" class="option">
                <div class="option-icon">
                    <svg>
                        <use href="../assets/icons/icons.svg?v=2#grayBook2-icon"></use>
                    </svg>
                </div>
                <div class="option-description">
                    <h3>Libros</h3>
                    <p>Accede al catálogo entero de libros.</p>
                </div>
            </a>
            <a href="./control.php?option=sagas" class="option">
                <div class="option-icon">
                    <svg>
                        <use href="../assets/icons/icons.svg?v=2#graySaga-icon"></use>
                    </svg>
                </div>
                <div class="option-description">
                    <h3>Sagas</h3>
                    <p>Accede al catálogo entero de sagas.</p>
                </div>
            </a>
            <a href="./control.php?option=autores" class="option">
                <div class="option-icon">
                    <svg>
                        <use href="../assets/icons/icons.svg#autor-icon"></use>
                    </svg>
                </div>
                <div class="option-description">
                    <h3>Autores</h3>
                    <p>Accede al catálogo entero de autores.</p>
                </div>
            </a>
            
        </div>
    </main>
</body>
</html>