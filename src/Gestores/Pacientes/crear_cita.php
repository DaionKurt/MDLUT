<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 27/03/2017
 * Time: 01:25 PM
 */
require "Administrador.php";
session_start();

$request = json_decode(file_get_contents("php://input"));
$medico = $request->medico;
$horario = $request->horario;
$anotaciones = $request->anotaciones;
$paciente = $_SESSION['paciente'];
$usuario = $_SESSION['usuario'];
$administrador = new Administrador($paciente,$usuario);
echo $administrador->crear_cita($medico,$horario,$anotaciones);
$administrador = null;