<?php
// Sirve para hacer un chequeo de sesión de usuario ya iniciada
// en un archivo aparte, evitando inicializar la sesión antes de incluso
// establecer las cookies de sesión

// Esto solo se usa en logIn.php, signUp.php y en index.php
session_start();

if (isset($_SESSION['check'])) {
    if ($_SESSION['check'] == 'OK') {
        header('Location: home.php');
        exit;
    }
} 

if ($_GET['request'] == 'login') {
    header('Location: logIn.php?checked=1');
} else if (($_GET['request'] == 'signup')) {
    header('Location: signUp.php?checked=1');
} else if (($_GET['request'] == 'index')) {
    header('Location: index.php?checked=1');
} 
?>