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
$sql_rec = "SELECT * FROM receta WHERE receta.no_paciente = '$paciente'";
$sql_med = "SELECT DISTINCT(medicamento.nombre),medicamento.informacion,medicamento.dosis,medicamento.via_administracion
FROM medicamento
INNER JOIN Medicamento_Recetado ON medicamento.id_medicamento = medicamento_recetado.id_medicamento
INNER JOIN Receta ON medicamento_recetado.id_receta = receta.id_receta
WHERE receta.no_paciente = '$paciente'";
try{
    $result=$conexion->query($sql_rec);
    $salida = "";
    while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Descripcion":"'.$rs["descripcion"] .'",';
        $salida .= '"Fecha_expediente":"'        .$rs["fecha_expedicion"]     .'",';
        $salida .= '"Fecha_limite":"'       .$rs["fecha_limite"]     .'"}';
    }
    $salida ='{"recetas":['.$salida.'],';
    $result=$conexion->query($sql_med);
    $out = "";
    while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($out != "") {$out .= ",";}
        $out .= '{"Medicamento":"'.$rs["nombre"] .'",';
        $out .= '"Informacion":"'        .$rs["informacion"]     .'",';
        $out .= '"Dosis":"'       .$rs["dosis"]     .'",';
        $out .= '"Via":"'     .$rs["via_administracion"].'"}';
    }
    $salida .='"medicamentos":['.$out.']}';
    $conexion = null;
    echo($salida);
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}