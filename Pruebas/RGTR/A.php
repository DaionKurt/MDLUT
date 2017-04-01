<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 30/03/2017
 * Time: 08:01 PM
 */
include "Perceptron.php";
$p = new Perceptron(6);
$i = 0;
while($i < 100000) {
    $entrada = array(0,0,0,0,0,0);
    $salida = 0;
    $p->entrena($entrada, $salida);
    $entrada = array(1,1,1,1,1,1);
    $salida = 1;
    $p->entrena($entrada, $salida);
    $i++;
}
echo $p->clasifica(array(1,1,1,1,1,1))  ? "Diabetes\n": "No Diabetes\n";
echo $p->clasifica(array(1,0.9,0,1,1,0))? "Diabetes\n": "No Diabetes\n";
echo $p->clasifica(array(0,0,0,0,0,0))  ? "Diabetes\n": "No Diabetes\n";
