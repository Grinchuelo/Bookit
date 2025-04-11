<header>
    <a href="home.php" class="home">Bookit</a>

    <div class="dropdown-container">
        <svg class="icon book">
            <use href="./assets/icons/icons.svg#bookUser-icon"></use>
        </svg>
        <div class="dropdown-options">
            <?php if (isset($_SESSION['check'])) { ?>
                <a href="./miBiblioteca.php">Mi biblioteca</a>
                <a href="./global/logout.php" style="color: #e72323">Cerrar sesión</a>
            <?php } else { ?>
                <a href="./signUp.php">Registrarme</a>
                <a href="./logIn.php">Iniciar sesión</a>
            <?php }?>
        </div>
    </a>
    
</header>