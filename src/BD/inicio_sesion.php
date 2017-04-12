<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 27/03/2017
 * Time: 01:25 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include('../Entidades/Usuario.php');
include('../Entidades/Paciente.php');
include('../Entidades/Medico.php');
session_start();
require('gestorBD.php');
$conexion = get_connection_test();
$JSON       = file_get_contents("php://input");
$request    = json_decode($JSON);
$usuario    = $request->usuario;
$pass       = $request->pass;

$sentencia=$conexion->prepare("SELECT * FROM usuario WHERE usuario.usuario = :usuario AND usuario.pass = :pass");
$sentencia->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$sentencia->bindParam(':pass', $pass, PDO::PARAM_STR);

$sentencia_p=$conexion->prepare("SELECT paciente.id_paciente ,paciente.estado_diabetico FROM usuario INNER JOIN paciente ON 
        usuario.id_usuario=paciente.no_usuario AND usuario.usuario=:usuario");
$sentencia_p->bindParam(':usuario', $usuario, PDO::PARAM_STR);

$sentencia_m=$conexion->prepare("SELECT medico.id_medico ,medico.no_cedula, medico.no_admon FROM usuario INNER JOIN medico ON 
        usuario.id_usuario=medico.no_usuario AND usuario.usuario=:usuario");
$sentencia_m->bindParam(':usuario', $usuario, PDO::PARAM_STR);
try{
    $sentencia->execute();
    $sentencia_p->execute();
    $sentencia_m->execute();
    $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
    $nombre_u = $usuario['nombre'];
    $apellido_u = $usuario['apellido'];
    $sexo_u = $usuario['sexo'];
    $fecha_nacimiento_u = $usuario['fecha_nacimiento'];
    $telefono_u = $usuario['fecha_nacimiento'];
    $edad_u = $usuario['edad'];
    $usuario_u = $usuario['usuario'];
    $correo_u = $usuario['correo'];
    $activo_u = $usuario['activo'];
    $id_u = $usuario['id_usuario'];
    $_SESSION['usuario'] = $id_u;
    $_SESSION['edad'] = $edad_u;
    if ($sentencia_p->rowCount()>=1) {
        $paciente_stm = $sentencia_p->fetch(PDO::FETCH_ASSOC);
        $id_p = $paciente_stm['id_paciente'];
        $estado_p = $paciente_stm['estado_diabetico'];
        $paciente_objeto = new \Entidades\Paciente($nombre_u,$apellido_u,$sexo_u,$fecha_nacimiento_u,$telefono_u,
            $edad_u,$usuario_u,$correo_u,$activo_u,$id_u,$estado_p,$id_p);
        $_SESSION['paciente'] = $id_p;
        $_SESSION['objeto'] = serialize($paciente_objeto);
    }
    if($sentencia_m->rowCount()>=1){
        $medico_stm = $sentencia_m->fetch(PDO::FETCH_ASSOC);
        $id_m = $medico_stm['id_medico'];
        $no_admon = $medico_stm['no_admon'];
        $cedula_m = $medico_stm['no_cedula'];
        $medico_objeto = new \Entidades\Medico($nombre_u,$apellido_u,$sexo_u,$fecha_nacimiento_u,
            $telefono_u,$edad_u,$usuario_u,$correo_u,$activo_u,$id_u,$cedula_m,
            $id_m,$no_admon);
        $_SESSION['medico'] = $id_m;
        $_SESSION['objeto'] = serialize($medico_objeto);
    }
    $conexion = null;
    echo  json_encode($usuario);
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}