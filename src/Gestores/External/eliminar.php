<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 13/04/2017
 * Time: 07:28 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "../../BD/gestorBD.php";
session_start();
$request = json_decode(file_get_contents("php://input"));
$IDX = $request->IDX;

$conexion = get_connection_test();
$eliminar = $conexion->prepare("DELETE FROM usuario WHERE id_usuario = :IDX");
$eliminar->bindParam(':IDX',$IDX,PDO::PARAM_INT);
$eliminar->execute();

unset($_SESSION['usuario']);
unset($_SESSION['objeto']);
if(isset($_SESSION['paciente'])){
    unset($_SESSION['paciente']);
}
if(isset($_SESSION['medico'])){
    unset($_SESSION['medico']);
}
if(session_destroy()){
    header("Location: ../../../index.php");
}