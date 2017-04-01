<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 27/03/2017
 * Time: 01:25 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include('../../Entidades/Usuario.php');
include('../../Entidades/Paciente.php');
session_start();
require('../../BD/gestorBD.php');
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$request = json_decode(file_get_contents("php://input"));
$medico = $request->medico;
$horario = $request->horario;
$paciente = $_SESSION['paciente'];
$update = "UPDATE Horario SET libre = 0 WHERE id_horario = '$horario';";
$sql = "INSERT INTO Cita(no_medico,no_paciente,horario,anotaciones) VALUES ('$medico','$paciente','$horario','Prueba general')";
try{
    $stmt = $conexion->query($update);
    $stmt = $conexion->query($sql);
    $conexion = null;
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}