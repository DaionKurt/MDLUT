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
require('gestorBD.php');
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$inner  = $_GET['inner'];
if($inner=="1"){
    $tabla = $_GET['tabla'];
    $elemento_p = $_GET['elemento_p'];
    $elemento_s = $_GET['elemento_s'];
    $sql = "SELECT * FROM $tabla WHERE '$elemento_p' = '$elemento_s'";
}else{
    $tabla_principal  = $_GET['tabla_p'];
    $tabla_secundaria = $_GET['tabla_s'];
    $sql = "SELECT * FROM $tabla_principal INNER JOIN $tabla_secundaria ON usuario.id_usuario=medico.no_usuario";
}
try{
    $result=$conexion->query($sql);
    $salida = "";
    while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Nombre":"' .$rs["nombre"]   .'",';
        $salida .= '"Apellido":"'.$rs["apellido"] .'",';
        $salida .= '"Cedula":"'    .$rs["no_cedula"]     .'",';
        $salida .= '"Correo":"'  .$rs["correo"]   .'"}';
    }
    $salida ='{"registro":['.$salida.']}';
    $conexion = null;
    echo($salida);
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}