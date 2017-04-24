<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 17/04/2017
 * Time: 07:26 PM
 */

require('../src/BD/gestorBD.php');
require "../src/Inteligente/Fuzzy.php";
require "../src/Inteligente/Perceptron.php";
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!($socket = socket_create(AF_INET,SOCK_STREAM,IPPROTO_IP))){
    $codigo_error = socket_last_error();
    $mensaje_error = socket_strerror($codigo_error);
    die("No se pudo crear el socket: [$codigo_error] $mensaje_error \n");
}
echo  "Socket creado\n";
if(!socket_connect($socket,'127.0.0.1',100)){
//if(!socket_connect($socket,'192.168.1.64',100)){
    $codigo_error = socket_last_error();
    $mensaje_error = socket_strerror($codigo_error);
    die("No se pudo conectar el socket: [$codigo_error] $mensaje_error \n");
}
echo "Conexion establecida\n";

$edad = 20;
$glucosa = 140;
$imc = 23;
$informacion = $edad.",".$glucosa.",".$imc.",0,1,1,1,1,1";
if(!socket_send($socket,$informacion,strlen($informacion),0)){
    $codigo_error = socket_last_error();
    $mensaje_error = socket_strerror($codigo_error);
    die("No se pudo enviar datos: [$codigo_error] $mensaje_error \n");
}
echo "Mensaje enviado exitosamente\n";
if(socket_recv($socket,$buffer,1024,MSG_WAITALL)===false){
    $codigo_error = socket_last_error();
    $mensaje_error = socket_strerror($codigo_error);
    die("No se recibio respuesta: [$codigo_error] $mensaje_error \n");
}
echo "Respuesta recibida: \n".$buffer."\n";
socket_close($socket);

$obj = json_decode($buffer);
$paciente = 1;
$imc = 330;
$glucosa = 100;
$condicion = $obj->{'resultado'};
$glucosa_d = $obj->{'glucosa'};
$certeza_d = $obj->{'certeza'};
$fecha = "01/14/2017";

$sql = "INSERT INTO diagnostico(no_paciente,estado,imc,niv_glucosa,cat_glucosa,porc_certeza,fecha)
 VALUES ('$paciente','$condicion','$imc','$glucosa','$glucosa_d','$certeza_d','$fecha')";
try{
    $stmt = $conexion->query($sql);
    echo $buffer;
    $conexion = null;
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}