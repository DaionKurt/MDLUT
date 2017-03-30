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
$usuario = $_SESSION['usuario'];
$sql = "SELECT * FROM usuario INNER JOIN paciente ON 
        usuario.id_usuario=paciente.no_usuario AND usuario.id_usuario= '$usuario'";
try{
    $result=$conexion->query($sql);
    $salida = "";
    while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Nombre":"' .$rs["nombre"]   .'",';
        $salida .= '"Apellido":"'.$rs["apellido"] .'",';
        $salida .= '"Sexo":"'    .$rs["sexo"]     .'",';
        $salida .= '"Fecha":"'   .$rs["fecha_nacimiento"]     .'",';
        $salida .= '"Telefono":"'.$rs["telefono"]     .'",';
        $salida .= '"Edad":"'    .$rs["edad"]     .'",';
        $salida .= '"Usuario":"' .$rs["usuario"]     .'",';
        $salida .= '"Correo":"'  .$rs["correo"]     .'",';
        $salida .= '"Estado":"'  .$rs["estado_diabetico"]   .'"}';
    }
    $conexion = null;
    echo($salida);
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}