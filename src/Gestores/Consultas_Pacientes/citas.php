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
$sql = "SELECT * FROM Usuario
INNER JOIN Medico ON Usuario.id_usuario=Medico.no_usuario
INNER JOIN Cita ON cita.no_medico=Medico.id_medico
INNER JOIN Horario ON horario.id_horario = cita.horario
WHERE cita.no_paciente = '$paciente'";
try{
    $result=$conexion->query($sql);
    $salida = "";
    while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Anotaciones":"'.$rs["anotaciones"] .'",';
        $salida .= '"Dia":"'        .$rs["dia"]     .'",';
        $salida .= '"Hora":"'       .$rs["hora"]     .'",';
        $salida .= '"Medico":"'     .$rs["nombre"]." ".$rs["apellido"]    .'",';
        $salida .= '"Cedula":"'     .$rs["no_cedula"].'"}';
    }
    $salida ='{"citas":['.$salida.']}';
    $conexion = null;
    echo($salida);
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}