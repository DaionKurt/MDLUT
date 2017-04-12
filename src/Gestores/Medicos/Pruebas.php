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

$paciente_IDX = 1;

$sentencia = $conexion->prepare("
           SELECT * FROM Diagnostico 
INNER JOIN Paciente WHERE Diagnostico.no_paciente = :paciente AND Paciente.id_paciente = :paciente_s");
$sentencia->bindParam(':paciente',$paciente_IDX,PDO::PARAM_INT);
$sentencia->bindParam(':paciente_s',$paciente_IDX,PDO::PARAM_INT);

try{
    $sentencia->execute();
    $salida = "";
    while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Estado":"' .$rs["estado"]   .'",';
        $salida .= '"IMC":"'     .$rs["imc"] .'",';
        $salida .= '"Glucosa":"' .$rs["niv_glucosa"]     .'",';
        $salida .= '"Cat_g":"'   .$rs["cat_glucosa"]     .'",';
        $salida .= '"Certeza":"' .$rs["porc_certeza"]     .'"}';
    }
    $salida ='{"diagnosticos":['.$salida.']}';
    echo $salida;
}catch(PDOException $e){
    return '{"error":{"error":'. $e->getMessage() .'}}';
}

/*
$medico_IDX = 1;
$sentencia = $conexion->prepare("
              SELECT * FROM usuario INNER JOIN medico ON usuario.id_usuario=medico.no_usuario AND usuario.id_usuario=:medico");
$sentencia->bindParam(':medico',$medico_IDX,PDO::PARAM_INT);
try{
    $sentencia->execute();
    $salida = "";
    while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Nombre":"'    .$rs["nombre"]          .'",';
        $salida .= '"Apellido":"'   .$rs["apellido"]        .'",';
        $salida .= '"Sexo":"'       .$rs["sexo"]            .'",';
        $salida .= '"Fecha":"'      .$rs["fecha_nacimiento"].'",';
        $salida .= '"Telefono":"'   .$rs["telefono"]        .'",';
        $salida .= '"Edad":"'       .$rs["edad"]            .'",';
        $salida .= '"Usuario":"'    .$rs["usuario"]         .'",';
        $salida .= '"Correo":"'     .$rs["correo"]          .'",';
        $salida .= '"Cedula":"'     .$rs["no_cedula"]       .'",';
        $salida .= '"Grado":"'      .$rs["grado"]           .'",';
        $salida .= '"Especialidad":"'.$rs["especialidad"]   .'",';
        $salida .= '"Universidad":"'.$rs["universidad"]     .'"}';
    }
    return $salida;
}catch(PDOException $e) {
    return '{"error":{"error":' . $e->getMessage() . '}}';
}
*/
/*
$medico_n = "1; DROP DATABASE Diaman;";
$sentencia=$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$sentencia=$conexion->prepare("SELECT * FROM horario WHERE medico = :medico");
$sentencia->bindParam(':medico', $medico_n, PDO::PARAM_STR);
#$sentencia->execute();
#print_r($sentencia->fetch(PDO::FETCH_ASSOC));

try{
    $sentencia->execute();
    $salida = "";
    while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Dia":"'.$rs["dia"] .'",';
        $salida .= '"Hora":"'        .$rs["hora"]     .'",';
        $salida .= '"Libre":"'       .$rs["libre"]     .'"}';
    }
    $salida ='{"horarios":['.$salida.']}';
    echo $salida;
}catch(PDOException $e){
    return '{"error":{"error":'. $e->getMessage() .'}}';
}*/