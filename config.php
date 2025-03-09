<?php
// Detectar si estamos en el entorno local o en producción 
$local = ($_SERVER['SERVER_NAME'] == 'localhost');

require __DIR__ . "/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($local) {
    // Configuración para entorno local (XAMPP)
    $host = $_ENV['LOCAL_HOST'];
    $bd = $_ENV['LOCAL_DATABASE'];
    $usuario = $_ENV['LOCAL_USER'];
    $contrasenia = $_ENV['LOCAL_PASSWORD'];
} else {
    // Configuración para DonWeb
    $host = $_ENV['HOST'];  
    $bd = $_ENV['DATABASE'];
    $usuario = $_ENV['USER'];  
    $contrasenia = $_ENV['PASSWORD'];  
}

try {
    $conection = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
    $conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    error_log($ex->getMessage());
    echo "La conexión falló. Por favor intentá de nuevo más tarde.";
}

session_set_cookie_params([
    "lifetime" => 10, // 1 hora de sesión
    "path" => "/",
    "domain" => $_SERVER['HTTP_HOST'], // Se adapta al entorno
    "secure" => true,  // Solo en HTTPS
    "httponly" => true,  // No accesible desde JavaScript
    "samesite" => "Strict" // Protección contra CSRF
]);

session_start();

?>
