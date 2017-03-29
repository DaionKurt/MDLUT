<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 28/03/2017
 * Time: 12:31 PM
 */
session_start();
unset($_SESSION['usuario']);
if(isset($_SESSION['paciente'])){
    unset($_SESSION['paciente']);
}
if(isset($_SESSION['medico'])){
    unset($_SESSION['medico']);
}
if(session_destroy()){
    header("Location: ../../index.php");
}