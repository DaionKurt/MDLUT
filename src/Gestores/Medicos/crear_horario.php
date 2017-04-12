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
$dia = $request->dia;
$hora = $request->hora;
$aux_a = substr($dia,0,4);
$aux_b = substr($dia,5,2);
$aux_c = substr($dia,8,2);
$dia = $aux_c."/".$aux_b."/".$aux_a;
$medico = $_SESSION['medico'];
$usuario = $_SESSION['usuario'];
$administrador = new Administrador($medico,$usuario);
echo $administrador->crear_horario($dia,$hora);
$administrador = null;