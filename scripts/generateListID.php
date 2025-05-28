<?php
// oo gracias chatGPT
// Genera ID de listas en formato aaa000
function generarSiguienteID($id_anterior) {
    $letras = substr($id_anterior, 0, 3);
    $numeros = substr($id_anterior, 3, 3);

    $alfabeto = array_merge(range('a', 'z'), range('A', 'Z'));
    $base = count($alfabeto); // 52

    // Incrementar los números
    $numero = intval($numeros);
    if ($numero < 999) {
        $numero++;
        return $letras . str_pad($numero, 3, '0', STR_PAD_LEFT);
    }

    // Si los números llegaron a 999, reiniciar a 000 e incrementar letras
    $nuevoNumero = '000';

    // Convertir letras a un número base 52
    $valor = 0;
    for ($i = 0; $i < 3; $i++) {
        $valor *= $base;
        $valor += array_search($letras[$i], $alfabeto);
    }

    // Incrementar el valor
    $valor++;

    // Convertir de nuevo a letras en base 52
    $nuevasLetras = '';
    for ($i = 0; $i < 3; $i++) {
        $indice = intval($valor / pow($base, 2 - $i)) % $base;
        $nuevasLetras .= $alfabeto[$indice];
    }

    return $nuevasLetras . $nuevoNumero;
}
?>