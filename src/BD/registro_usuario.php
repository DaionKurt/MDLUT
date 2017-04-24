<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 27/03/2017
 * Time: 01:25 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require('gestorBD.php');
$conexion   = get_connection_test();
$request    = json_decode(file_get_contents("php://input"));
/*$nombre     = "Carlos";
$apellido   = "Fernández Jalomo";
$correo     = "carlosfdez@outlook.com";
$usuario    = "carlosfdez";
$pass       = "perrito";
$telefono   = "3321073333";
$sexo       = "M";
$edad       = 21;
$fecha_n    = "07/05/1995";*/
$nombre     = $request->nombre;
$apellido   = $request->apellido;
$correo     = $request->correo;
$usuario    = $request->usuario;
$pass       = $request->pass;
$telefono   = $request->telefono;
$sexo       = $request->sexo;
$edad       = $request->edad;
$fecha_n    = $request->fecha_nacimiento;
$imagen     = $sexo=="M"?"hombre.png":"mujer.png";

$aux_a   = substr($fecha_n,0,4);
$aux_b   = substr($fecha_n,5,2);
$aux_c   = substr($fecha_n,8,2);
$fecha_n = $aux_c."/".$aux_b."/".$aux_a;

$clave = (bin2hex(random_bytes(20)));

$sentencia=$conexion->prepare(
    "INSERT INTO Usuario(nombre,apellido,sexo,imagen,fecha_nacimiento,telefono,edad,usuario,correo,pass) 
               VALUES (:nombre,:apellido,:sexo,:imagen,:fecha,:telefono,:edad,:usuario,:correo,:pass)");
$sentencia->bindParam(':nombre'     , $nombre,  PDO::PARAM_STR);
$sentencia->bindParam(':apellido'   , $apellido,PDO::PARAM_STR);
$sentencia->bindParam(':sexo'       , $sexo,    PDO::PARAM_STR);
$sentencia->bindParam(':imagen'     , $imagen,    PDO::PARAM_STR);
$sentencia->bindParam(':fecha'      , $fecha_n, PDO::PARAM_STR);
$sentencia->bindParam(':telefono'   , $telefono,PDO::PARAM_STR);
$sentencia->bindParam(':edad'       , $edad,    PDO::PARAM_INT);
$sentencia->bindParam(':usuario'    , $usuario, PDO::PARAM_STR);
$sentencia->bindParam(':correo'     , $correo,  PDO::PARAM_STR);
$sentencia->bindParam(':pass'       , $pass,    PDO::PARAM_STR);



try{
    $sentencia->execute();
    $id = $conexion->lastInsertId();

    $verificacion=$conexion->prepare("INSERT INTO Usuario_Pendiente(id_usuario,usuario,correo,clave) 
                                                VALUES (:id,:usuario,:correo,:clave)");
    $verificacion->bindParam(':id'         , $id,      PDO::PARAM_STR);
    $verificacion->bindParam(':usuario'    , $usuario, PDO::PARAM_STR);
    $verificacion->bindParam(':correo'     , $correo,  PDO::PARAM_STR);
    $verificacion->bindParam(':clave'      , $clave,   PDO::PARAM_STR );
    $verificacion->execute();

    $message = '
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <style>
            .link{color: green;}
        </style>
    </head>
    <body>
      <p>Hola '.$nombre.' '.$apellido.',<br>Bienvenido!<br></p>
      <p>Nos da mucho gusto que formes parte de nuestro sistema: Diaman, esperamos te sea de mucha utilidad.</p>
      <p>Para finalizar el proceso de creación de tu cuenta, te pedimos des click en el siguiente link:</p>
      <a class="link" href="http://localhost:63342/Proyecto%20Modular/verificacion.php?id=' . $id . '&code=' . $clave
        . '&email='.$correo.'&user='.$usuario.'">
        Enlace de activación</a> 
      <p>Esto activará tu cuenta y podrás hacer uso del sistema</p>
      <p>Esperamos disfrutes del sitio y nos gustaría escuchar tus experiencias</p>
      <hr><p>Diaman <br> Diabetes Manager and Analyer</p>
    </body>
    </html>';
    $to=$correo;
    $subject="Activación de cuenta para Diaman";

    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[] = 'From: Equipo Diaman <carlosfdez@outlook.com>';
    mail($to, $subject, $message, implode("\r\n", $headers));

    $conexion = null;
    echo '{"exito":"1"}';
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}