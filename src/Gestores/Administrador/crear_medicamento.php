<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 13/04/2017
 * Time: 07:28 PM
 */
require "Administrador.php";
session_start();

$request = json_decode(file_get_contents("php://input"));
$nombre = $request->nombre;
$informacion = $request->informacion;
$dosis = $request->dosis;
$via = $request->via_administracion;

$admon  = $_SESSION['admon'];
$usuario = $_SESSION['usuario'];
$administrador = new Administrador($admon,$usuario);
echo $administrador->crear_medicamento($nombre,$informacion,$dosis,$via);
$administrador = null;