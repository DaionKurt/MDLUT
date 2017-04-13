<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 01/04/2017
 * Time: 10:16 AM
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
require('../../BD/gestorBD.php');
require "../../Inteligente/Fuzzy.php";
require "../../Inteligente/Perceptron.php";
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$peso  = $_GET['peso'];
$estatura = $_GET['estatura'];
$glucosa = $_GET['glucosa'];
$tiempo = $_GET['tiempo'];
$vision = $_GET['vision'];
$sed = $_GET['sed'];
$fatiga = $_GET['fatiga'];
$orina = $_GET['orina'];
$hambre = $_GET['hambre'];
$paciente = $_SESSION['paciente'];
$edad = $_SESSION['edad'];
$fecha = $_GET['fecha'];
$estatura/=100;
$imc = $peso/($estatura*$estatura);
/*echo '{"peso":'.$peso.',"estatura":'.$estatura.',"glucosa":'.$glucosa.',"tiempo":'.$tiempo.',"vision":'.$vision.',"sed":'.$sed.',"fatiga":'.$fatiga.',"orina":'.$orina. ',"hambre":'.$hambre.'}';
*//*$peso  = 70;$estatura = 170;$glucosa = 110;$tiempo = 0;$vision = 0;$sed = 0;$fatiga = 0;$orina = 0;$hambre = 0;
*//*$peso  = 100;$estatura = 140;$glucosa = 200;$tiempo = 1;$vision = 1;$sed = 1;$fatiga = 1;$orina = 1;$hambre = 1;*/
$p = new Perceptron(4);
$pollids  = "../../Inteligente/diabetes.csv";
$contents = file_get_contents($pollids);
$pollfields = explode(',', $contents);
$handle = fopen($pollids, "r");
$i = 0;
while($i < 100) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $entrada = array();
        for ($c = 0; $c < 4; $c++) {
            $entrada[] = $data[$c];
        }
        $salida = $data[$num - 1];
        $p->entrena($entrada, $salida);
    }
    $i++;
}
fclose($handle);
$resultado =  $p->clasifica(array($edad,$tiempo,$glucosa,$imc))?1: 0;
$string = '{"resultado":'.$resultado.',';
$fuzzy = new Fuzzy();
$edadDifusa=$fuzzy->fuzzificar_edad($edad);
$glucosaDifusa=$fuzzy->fuzzificar_glucosa($glucosa,$tiempo);
$imcDifuso=$fuzzy->fuzzificar_imc($imc);
$condicionDifusa=$fuzzy->inferirCondicionDifusaCualitativo($edadDifusa, $glucosaDifusa, $imcDifuso);
$nivMemCondicion=$fuzzy->inferirCondicionDifusaCuantitativo($edadDifusa, $glucosaDifusa, $imcDifuso);
$fuzzy->muestraNivMemMay("Membresías Condición",$fuzzy->getNivsMemCondicionDiabetico());
$condicionNitido=$fuzzy->desfuzzificar($condicionDifusa,$nivMemCondicion);
$string.='"result":'.json_encode($condicionDifusa).',"certeza":'.$nivMemCondicion.'}';
$sql = "INSERT INTO diagnostico(no_paciente,estado,imc,niv_glucosa,cat_glucosa,porc_certeza,fecha)
 VALUES ('$paciente','$condicionDifusa','$imc','$glucosa','$glucosaDifusa','$nivMemCondicion','$fecha')";
try{
    $stmt = $conexion->query($sql);
    echo $string;
    $conexion = null;
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}