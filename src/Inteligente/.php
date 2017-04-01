<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 30/03/2017
 * Time: 12:57 PM
 */
namespace Inteligente;
require("Fuzzy.php");

$fuzzy = new Fuzzy();
$edadNitida = 73;
$glucosaNitida= 145.0;
$aminoacidosNitido= 115.0;
$imcNitido= 22.1969;
$edadDifusa=$fuzzy->fuzzificar_edad($edadNitida);
$glucosaDifusa=$fuzzy->fuzzificar_glucosa($glucosaNitida);
$aminoacidosDifuso=$fuzzy->fuzzificar_aminoacidos($aminoacidosNitido);
$imcDifuso=$fuzzy->fuzzificar_imc($imcNitido);

echo "Para Edad=".$edadNitida." corresponde: ".$edadDifusa."\n";
echo "Para Glucosa=".$glucosaNitida." corresponde: ".$glucosaDifusa."\n";
echo "Para Aminoacidos=".$aminoacidosNitido." corresponde: ".$aminoacidosDifuso."\n";
echo "Para IMC=".$imcNitido." corresponde: ".$imcDifuso."\n";
$condicionDifusa=$fuzzy->inferirCondicionDifusaCualitativo($edadDifusa, $glucosaDifusa, $aminoacidosDifuso, $imcDifuso);
echo "La condición potencial que tienes es: ".$condicionDifusa;
$nivMemCondicion=$fuzzy->inferirCondicionDifusaCuantitativo($edadDifusa, $glucosaDifusa, $aminoacidosDifuso, $imcDifuso);
echo ", con una certeza de: ".$nivMemCondicion."\n";
$fuzzy->muestraNivMemMay("Membresías Condición",$fuzzy->getNivsMemCondicionDiabetico());
$condicionNitido=$fuzzy->desfuzzificar($condicionDifusa,$nivMemCondicion);
echo "Desfuzzificación correspondiente: ".$condicionNitido."\n";




