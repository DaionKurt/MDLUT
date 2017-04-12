<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 28/03/2017
 * Time: 05:31 PM
 */
require "Administrador.php";
session_start();
$paciente = $_SESSION['paciente'];
$usuario = $_SESSION['usuario'];
$administrador = new Administrador($paciente,$usuario);
echo $administrador->get_citas();
$administrador = null;