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
session_start();
require('gestorBD.php');
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$JSON       = file_get_contents("php://input");
$request    = json_decode($JSON);
$usuario    = $request->usuario;
$pass = $request->pass;
$sql =     "SELECT * FROM usuario WHERE usuario.usuario = '$usuario' AND usuario.pass= '$pass'";
$paciente ="SELECT paciente.id_paciente ,paciente.estado_diabetico FROM usuario INNER JOIN paciente ON 
        usuario.id_usuario=paciente.no_usuario AND usuario.usuario= '$usuario'";
$medico =  "SELECT medico.id_medico ,medico.no_cedula, medico.no_admon FROM usuario INNER JOIN medico ON 
        usuario.id_usuario=medico.no_usuario AND usuario.usuario= '$usuario'";
try{
    $stmt = $conexion->query($sql);
    $paciente_s = $conexion->query($paciente);
    $medico_s = $conexion->query($medico);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
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
    if ($paciente_s->rowCount()>=1) {
        $paciente_stm = $paciente_s->fetch(PDO::FETCH_ASSOC);
        $id_p = $paciente_stm['id_paciente'];
        $estado_p = $paciente_stm['estado_diabetico'];
        $paciente_objeto = new \Entidades\Paciente($nombre_u,$apellido_u,$sexo_u,$fecha_nacimiento_u,$telefono_u,
            $edad_u,$usuario_u,$correo_u,$activo_u,$id_u,$estado_p,$id_p);
        $_SESSION['usuario'] = $id_u;
        $_SESSION['paciente'] = serialize($paciente_objeto);
    }
    if($medico_s->rowCount()>=1){
        $medico_stm = $medico_s->fetch(PDO::FETCH_ASSOC);
        $id_m = $medico_stm['id_medico'];
        $no_admon = $medico_stm['no_admon'];
        $cedula_m = $medico_stm['no_cedula'];
        $medico_objeto = new \Entidades\Medico($nombre_u,$apellido_u,$sexo_u,$fecha_nacimiento_u,
            $telefono_u,$edad_u,$usuario_u,$correo_u,$activo_u,$id_u,$cedula_m,
            $id_m,$no_admon);
        $_SESSION['usuario'] = $id_u;
        $_SESSION['medico'] = serialize($medico_objeto);
    }
    $conexion = null;
    echo  json_encode($usuario);
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}