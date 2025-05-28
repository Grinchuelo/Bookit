<header>
    <a href="home.php" class="home">Bookit</a>

    <div class="right-container">
        <div class="username-container">
            <span class="headerUsername"><?php
            if (isset($_SESSION['username'])) {
                echo $_SESSION['username'];
            }
            ?></span>
        </div>
        <div id="dropdown-container" class="dropdown-container" onclick="dropdownOptions(event, this)">
            <svg id="clickToDropdown" class="icon book">
                <use href="./assets/icons/icons.svg#bookUser-icon"></use>
            </svg>
            <div class="dropdown-options" style="display: none">
                <?php if (isset($_SESSION['check'])) { ?>
                    <a href="./miBiblioteca.php">Mi biblioteca</a>
                    <a href="./global/logout.php" style="color: #e72323">Cerrar sesión</a>
                <?php } else { ?>
                    <a href="./preCheck.php?request=signup">Registrarme</a>
                    <a href="./preCheck.php?request=login">Iniciar sesión</a>
                <?php }?>
            </div>
        </div>
    </div>
</header>