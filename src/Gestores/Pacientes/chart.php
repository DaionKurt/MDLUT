<?php
require "Administrador.php";
session_start();
$paciente = $_SESSION['paciente'];
$usuario = $_SESSION['usuario'];
$administrador = new Administrador($paciente,$usuario);
echo $administrador->get_datos_grafico();
$administrador = null;
?>