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
    $host = $_ENV['DB_HOST'];  
    $bd = $_ENV['DB_NAME'];
    $usuario = $_ENV['DB_USER'];  
    $contrasenia = $_ENV['DB_PASSWORD'];  
}

try {
    $conection = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
    $conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    error_log($ex->getMessage());
    echo "La conexión falló. Por favor intentá de nuevo más tarde.";
}

session_set_cookie_params([
    "lifetime" => time() + 60*60*4, // 4 horas de sesión
    "path" => "/", // La cookie se carga en cualquier parte del sitio
    "domain" => $_SERVER['HTTP_HOST'], // Se adapta al entorno ya sea local o producción
    "secure" => true,  // Solo en HTTPS
    "httponly" => true,  // No es accesible desde JavaScript (Anti-XSS)
    "samesite" => "Strict" // Protección contra CSRF
]);

session_start();
?>
