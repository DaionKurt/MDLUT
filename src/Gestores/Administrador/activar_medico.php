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
$IDX = $request->IDX;
$admon  = $_SESSION['admon'];
$usuario = $_SESSION['usuario'];
$administrador = new Administrador($admon,$usuario);
$administrador->activar_medico($IDX);
$administrador = null;