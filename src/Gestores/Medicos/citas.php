<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 28/03/2017
 * Time: 05:31 PM
 */
require "Administrador.php";
session_start();
$medico = $_SESSION['medico'];
$usuario = $_SESSION['usuario'];
$administrador = new Administrador($medico,$usuario);
echo $administrador->get_citas();
$administrador = null;