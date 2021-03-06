<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 01/04/2017
 * Time: 10:16 AM
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
require('../../BD/gestorBD.php');
require "../../Inteligente/Fuzzy.php";
require "../../Inteligente/Perceptron.php";
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$peso  = $_GET['peso'];
$estatura = $_GET['estatura'];
$glucosa = $_GET['glucosa'];
$tiempo = $_GET['tiempo'];
$vision = $_GET['vision'];
$familiar = $_GET['familiar'];
$fatiga = $_GET['fatiga'];
$orina = $_GET['orina'];
$gestar = $_GET['gestar'];
$paciente = $_SESSION['paciente'];
$edad = $_SESSION['edad'];
$fecha = $_GET['fecha'];
$estatura/=100;
$imc = $peso/($estatura*$estatura);

//$informacion = $peso.",".$estatura.",".$glucosa.",".$tiempo.",".$vision.",".$sed.",".$fatiga.",".$orina.",".$hambre.",".$edad.",".$imc;
$informacion = $edad.",".$glucosa.",".$imc.",".$tiempo.",".$familiar.",".$gestar.",".$vision.",".$fatiga.",".$orina;
//$informacion = $edad.",".$glucosa.",".$imc.",0,1";
if(!($socket = socket_create(AF_INET,SOCK_STREAM,IPPROTO_IP))){
    $codigo_error = socket_last_error();
    $mensaje_error = socket_strerror($codigo_error);
    die("No se pudo crear el socket: [$codigo_error] $mensaje_error \n");
}
if(!socket_connect($socket,'192.168.1.64',100)){
    $codigo_error = socket_last_error();
    $mensaje_error = socket_strerror($codigo_error);
    die("No se pudo conectar el socket: [$codigo_error] $mensaje_error \n");
}
$texto_prueba = "hora";
if(!socket_send($socket,$informacion,strlen($informacion),0)){
    $codigo_error = socket_last_error();
    $mensaje_error = socket_strerror($codigo_error);
    die("No se pudo enviar datos: [$codigo_error] $mensaje_error \n");
}
if(socket_recv($socket,$buffer,1024,MSG_WAITALL)===false){
    $codigo_error = socket_last_error();
    $mensaje_error = socket_strerror($codigo_error);
    die("No se recibio respuesta: [$codigo_error] $mensaje_error \n");
}
socket_close($socket);

$obj = json_decode($buffer);
$condicion = utf8_encode($obj->{'resultado'});
$glucosa_d = $obj->{'glucosa'};
$certeza_d = $obj->{'certeza'}*100;

$sql = "INSERT INTO diagnostico(no_paciente,estado,imc,niv_glucosa,cat_glucosa,porc_certeza,fecha)
 VALUES ('$paciente','$condicion','$imc','$glucosa','$glucosa_d','$certeza_d','$fecha')";
try{
    $stmt = $conexion->query($sql);
    echo $buffer;
    $conexion = null;
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}