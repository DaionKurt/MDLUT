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
$citas = "SELECT * FROM Usuario
INNER JOIN Medico ON Usuario.id_usuario=Medico.no_usuario
INNER JOIN Cita ON cita.no_medico=Medico.id_medico
INNER JOIN Horario ON horario.id_horario = cita.horario
WHERE cita.no_paciente = '$paciente'";
$max_medico = "SELECT MAX(id_medico) FROM Medico";
try{
    $result=$conexion->query($citas);
    $salida = "";
    while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Anotaciones":"'.$rs["anotaciones"] .'",';
        $salida .= '"Dia":"'        .$rs["dia"]     .'",';
        $salida .= '"Hora":"'       .$rs["hora"]     .'",';
        $salida .= '"Medico":"'     .$rs["nombre"]." ".$rs["apellido"]    .'",';
        $salida .= '"Cedula":"'     .$rs["no_cedula"].'"}';
    }
    $salida ='{"citas":['.$salida.'],';
    $ja=$conexion->query($max_medico);
    $je = $ja->fetch(PDO::FETCH_ASSOC);
    $j = intval($je['MAX(id_medico)']);
    $out = "";
    for($i=1;$i<=$j;++$i){
        $result=$conexion->query("SELECT horario.dia,horario.hora,horario.id_horario,usuario.nombre,usuario.apellido,medico.no_cedula,medico.universidad,medico.especialidad,medico.id_medico
 FROM Horario
INNER JOIN Medico ON medico.id_medico = horario.medico
INNER JOIN Usuario ON usuario.id_usuario = medico.no_usuario
WHERE medico.id_medico = '$i' AND horario.libre = 1;");
        $k = 1;
        $entre = false;
        while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
            $entre = true;
            if ($out != "") {$out .= ",";}
            if($k==1){
                $out .= '{"Nombre":"'.$rs["nombre"] .' '.$rs["apellido"] .'",';
                $out .= '"Universidad":"'.$rs["universidad"] .'",';
                $out .= '"Especialidad":"'.$rs["especialidad"] .'",';
                $out .= '"ND":"'.$rs["id_medico"] .'",';
                $out .= '"Cedula":"'        .$rs["no_cedula"]     .'","horarios":[';
                $k++;
            }
            $out .= '{"Fecha":"'        .$rs["dia"]." - ".$rs["hora"]     .'",';
            $out .= '"ND":"'        .$rs["id_horario"]     .'"}';
        }
        if($entre) $out .= "]}";
    }
    $salida .='"medicos":['.$out.']}';
    $conexion = null;
    echo($salida);
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}