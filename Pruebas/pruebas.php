<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 04/04/2017
 * Time: 05:53 PM
 */
require "Perceptron.php";
$p = new Perceptron(7);
$pollids  = "diabetes.csv";
$contents = file_get_contents($pollids);
$pollfields = explode(',', $contents);
$handle = fopen($pollids, "r");
$i = 0;
while($i < 100) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $entrada = array();
        for ($c = 0; $c < $num - 1; $c++) {
            $entrada[] = $data[$c];
        }
        $salida = $data[$num - 1];
        $p->entrena($entrada, $salida);
    }
    $i++;
}
fclose($handle);
$resultado =  $p->clasifica(array(37,0,157,25.6,188,195,1))?1: 0;
echo '{"resultado":'.$resultado.'}';
$resultado =  $p->clasifica(array(6,1,69,27.7,310,193,1))?1: 0;
echo '{"resultado":'.$resultado.'}';