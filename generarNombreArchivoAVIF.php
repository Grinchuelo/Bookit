<?php
/* Esto crea los nombres de las imágenes en formato camelCase y agrega la
extensión AVIF */
function generarNombreArchivoAVIF($nombre_archivo) {
    include('./config.php');

    // Sacar tildes y otros diacríticos
    $unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
    'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
    'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
    'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
    'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', '-' => ' ', '.' => ' ');
    $nombre_archivo = strtr($nombre_archivo, $unwanted_array );

    // Sacar guiones y otros caracteres especiales que no sean letras o numeros
    $nombreSinCaracteresEsp = preg_replace('([^A-Za-z0-9\s])', '', $nombre_archivo);
    echo $nombreSinCaracteresEsp;
    $arr_nombre_archivo = explode(" ", strtolower($nombreSinCaracteresEsp));
    
    for ($i = 0; $i < count($arr_nombre_archivo); $i++) {
        if ($i > 0) {
            $arr_nombre_archivo[$i] = ucfirst(strtolower($arr_nombre_archivo[$i]));
        }
    }

    $nombre_archivoAVIF = implode('', $arr_nombre_archivo).'.avif';

    return $nombre_archivoAVIF;
}
?>