<?php
// Detectar si estamos en el entorno local o en producción (DonWeb)
$local = ($_SERVER['SERVER_NAME'] == 'localhost');

if ($local) {
    // Configuración para entorno local (XAMPP)
    $host = "localhost";
    $bd = "bookit";
    $usuario = "root";
    $contrasenia = "";
} else {
    // Configuración para DonWeb
    $host = "localhost";  
    $bd = PROTECTEDbyBFG;
    $usuario = PROTECTEDbyBFG;  
    $contrasenia = PROTECTEDbyBFG;  
}

try {
    $conection = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
    $conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    error_log($ex->getMessage());
    echo "Connection failed: Please try again later.";
}
?>
