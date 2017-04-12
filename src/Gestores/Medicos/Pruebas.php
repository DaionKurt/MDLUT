<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 11/04/2017
 * Time: 10:27 AM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "../../BD/gestorBD.php";
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sql = "SELECT * FROM horario WHERE medico=1";
try{
    $result=$conexion->query($sql);
    $salida = "";
    while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Dia":"'.$rs["dia"] .'",';
        $salida .= '"Hora":"'        .$rs["hora"]     .'",';
        $salida .= '"Libre":"'       .$rs["libre"]     .'"}';
    }
    $salida ='{"horarios":['.$salida.']}';
    echo $salida;
}catch(PDOException $e){
    return '{"error":{"error":'. $e->getMessage() .'}}';
}