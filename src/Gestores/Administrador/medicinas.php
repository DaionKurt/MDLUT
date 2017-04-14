<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 28/03/2017
 * Time: 05:31 PM
 */
require "Administrador.php";
session_start();
$admon  = $_SESSION['admon'];
$usuario = $_SESSION['usuario'];
$administrador = new Administrador($admon,$usuario);
echo $administrador->get_medicinas();
$administrador = null;