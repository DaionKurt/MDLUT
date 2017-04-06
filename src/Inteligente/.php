<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 30/03/2017
 * Time: 12:57 PM
 */
include "Fuzzy.php";

$fuzzy = new Fuzzy();
$edadNitida = 71;
$glucosaNitida= 240.0;
$imcNitido= 16;
$edadDifusa=$fuzzy->fuzzificar_edad($edadNitida);
$glucosaDifusa=$fuzzy->fuzzificar_glucosa($glucosaNitida,0);
$imcDifuso=$fuzzy->fuzzificar_imc($imcNitido);

echo "Para Edad=".$edadNitida." corresponde: ".$edadDifusa."\n";
echo "Para Glucosa=".$glucosaNitida." corresponde: ".$glucosaDifusa."\n";
echo "Para IMC=".$imcNitido." corresponde: ".$imcDifuso."\n";
$condicionDifusa=$fuzzy->inferirCondicionDifusaCualitativo($edadDifusa, $glucosaDifusa, $imcDifuso);
echo "La condición potencial que tienes es: ".$condicionDifusa;
$nivMemCondicion=$fuzzy->inferirCondicionDifusaCuantitativo($edadDifusa, $glucosaDifusa, $imcDifuso);
echo ", con una certeza de: ".$nivMemCondicion."\n";
$fuzzy->muestraNivMemMay("Membresías Condición",$fuzzy->getNivsMemCondicionDiabetico());
$condicionNitido=$fuzzy->desfuzzificar($condicionDifusa,$nivMemCondicion);
echo "Desfuzzificación correspondiente: ".$condicionNitido."\n";




