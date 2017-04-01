<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 28/03/2017
 * Time: 06:50 PM

session_start();
include('../Entidades/Usuario.php');
include('../Entidades/Paciente.php');
include('../Entidades/Medico.php');
$objeto="{}";
if(isset($_SESSION['paciente'])){
    $objeto = unserialize($_SESSION['paciente']);
}else if(isset($_SESSION['medico'])){
    $objeto = unserialize($_SESSION['medico']);
}
echo json_encode($objeto);*/
echo "Hola Mundo ofuscado perro!";
?>
