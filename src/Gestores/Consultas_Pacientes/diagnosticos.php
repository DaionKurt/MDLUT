<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 28/03/2017
 * Time: 05:31 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
require('../../BD/gestorBD.php');
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$paciente = $_SESSION['paciente'];
$sql = "SELECT * FROM Diagnostico INNER JOIN Paciente ON Paciente.id_paciente = '$paciente' AND Diagnostico.no_paciente = '$paciente'";
try{
    $result=$conexion->query($sql);
    $salida = "";
    while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Estado":"' .$rs["estado"]   .'",';
        $salida .= '"IMC":"'     .$rs["imc"] .'",';
        $salida .= '"Glucosa":"' .$rs["niv_glucosa"]     .'",';
        $salida .= '"Cat_g":"'   .$rs["cat_glucosa"]     .'",';
        $salida .= '"Certeza":"' .$rs["porc_certeza"]     .'"}';
    }
    $salida ='{"diagnosticos":['.$salida.']}';
    $conexion = null;
    echo($salida);
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}