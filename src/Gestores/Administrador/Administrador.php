<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 06/04/2017
 * Time: 06:35 PM
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "../../BD/gestorBD.php";

class Administrador{

    private $conexion;
    private $admon_IDX;
    private $usuario_IDX;

    function __construct($admon,$usuario){
        $this->admon_IDX    = $admon;
        $this->usuario_IDX  = $usuario;
        $this->conexion     = get_connection_test();
    }
    function __destruct(){
        $this->conexion = null;
    }
    function get_pacientes(){
        $sentencia = $this->conexion->prepare("
                SELECT usuario.nombre,usuario.apellido,usuario.sexo,usuario.fecha_nacimiento,usuario.imagen,
                 usuario.telefono, usuario.edad, usuario.correo,usuario.id_usuario,paciente.estado_diabetico FROM paciente
                INNER JOIN usuario ON usuario.id_usuario = paciente.no_usuario
                WHERE activo = 1 ORDER BY apellido,nombre;");
        try {
            $sentencia->execute();
            $salida = "";
            while ($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Nombre":"' . $rs["nombre"] . ' ' . $rs["apellido"] . '",';
                $salida .= '"Sexo":"' . $rs["sexo"] . '",';
                $salida .= '"IDX":"' . $rs["id_usuario"] . '",';
                $salida .= '"Fecha":"' . $rs["fecha_nacimiento"] . '",';
                $salida .= '"Imagen":"' . $rs["imagen"] . '",';
                $salida .= '"Telefono":"' . $rs["telefono"] . '",';
                $salida .= '"Edad":"' . $rs["edad"] . '",';
                $salida .= '"Correo":"' . $rs["correo"] . '",';
                $salida .= '"Estado":"' . $rs["estado_diabetico"] . '"}';
            }
            $salida = '{"pacientes":[' . $salida . ']}';
            return $salida;
        } catch (PDOException $e) {
            return '{"error":{"error":' . $e->getMessage() . '}}';
        }
    }
    function get_medicos(){
        $sentencia = $this->conexion->prepare("
                SELECT usuario.nombre,usuario.apellido,usuario.sexo,usuario.fecha_nacimiento,usuario.imagen,
                 usuario.telefono, usuario.edad, usuario.correo, medico.no_cedula, medico.grado,
                 medico.especialidad, medico.universidad, usuario.id_usuario FROM medico
                INNER JOIN usuario ON usuario.id_usuario = medico.no_usuario
                WHERE activo = 1 ORDER BY apellido,nombre;");
        $pendientes = $this->conexion->prepare("
                SELECT usuario.id_usuario,usuario.nombre,usuario.apellido,usuario.sexo,usuario.fecha_nacimiento,usuario.imagen,
                 usuario.telefono, usuario.edad, usuario.correo, medico_pendiente.no_cedula, medico_pendiente.grado,
                 medico_pendiente.especialidad, medico_pendiente.universidad FROM medico_pendiente
                INNER JOIN usuario ON usuario.id_usuario = medico_pendiente.no_usuario ORDER BY apellido,nombre;");
        try {
            $sentencia->execute();
            $pendientes->execute();
            $salida = "";
            while ($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Medico":"' . $rs["nombre"] . ' ' . $rs["apellido"] . '",';
                $salida .= '"Sexo":"' . $rs["sexo"] . '",';
                $salida .= '"IDX":"' . $rs["id_usuario"] . '",';
                $salida .= '"Fecha":"' . $rs["fecha_nacimiento"] . '",';
                $salida .= '"Imagen":"' . $rs["imagen"] . '",';
                $salida .= '"Telefono":"' . $rs["telefono"] . '",';
                $salida .= '"Edad":"' . $rs["edad"] . '",';
                $salida .= '"Correo":"' . $rs["correo"] . '",';
                $salida .= '"Cedula":"' . $rs["no_cedula"] . '",';
                $salida .= '"Grado":"' . $rs["grado"] . '",';
                $salida .= '"Especialidad":"' . $rs["especialidad"] . '",';
                $salida .= '"Universidad":"' . $rs["universidad"] . '"}';
            }
            $salida = '{"medicos":[' . $salida . '],';
            $pendiente_s = "";
            while ($rs = $pendientes->fetch(PDO::FETCH_ASSOC)) {
                if ($pendiente_s != "") {
                    $pendiente_s .= ",";
                }
                $pendiente_s .= '{"Medico":"' . $rs["nombre"] . ' ' . $rs["apellido"] . '",';
                $pendiente_s .= '"Sexo":"' . $rs["sexo"] . '",';
                $pendiente_s .= '"IDX":"' . $rs["id_usuario"] . '",';
                $pendiente_s .= '"Fecha":"' . $rs["fecha_nacimiento"] . '",';
                $pendiente_s .= '"Imagen":"' . $rs["imagen"] . '",';
                $pendiente_s .= '"Telefono":"' . $rs["telefono"] . '",';
                $pendiente_s .= '"Edad":"' . $rs["edad"] . '",';
                $pendiente_s .= '"Correo":"' . $rs["correo"] . '",';
                $pendiente_s .= '"Cedula":"' . $rs["no_cedula"] . '",';
                $pendiente_s .= '"Grado":"' . $rs["grado"] . '",';
                $pendiente_s .= '"Especialidad":"' . $rs["especialidad"] . '",';
                $pendiente_s .= '"Universidad":"' . $rs["universidad"] . '"}';
            }
            return $salida.='"pendientes":['.$pendiente_s.']}';
        } catch (PDOException $e) {
            return '{"error":{"error":' . $e->getMessage() . '}}';
        }
    }
    function get_medicinas(){
        $sentencia = $this->conexion->prepare("
                SELECT medicamento.nombre, medicamento.informacion, medicamento.dosis,medicamento.via_administracion
                 FROM medicamento ORDER BY nombre;");
        try {
            $sentencia->execute();
            $salida = "";
            while ($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Nombre":"' . $rs["nombre"] . '",';
                $salida .= '"Informacion":"' . $rs["informacion"] . '",';
                $salida .= '"Dosis":"' . $rs["dosis"] . '",';
                $salida .= '"Via":"' . $rs["via_administracion"] . '"}';
            }
            $salida = '{"medicamentos":[' . $salida . ']}';
            return $salida;
        } catch (PDOException $e) {
            return '{"error":{"error":' . $e->getMessage() . '}}';
        }
    }
    function activar_medico($IDX){
        $obtener = $this->conexion->prepare("SELECT * FROM medico_pendiente WHERE no_usuario = :IDX");
        $obtener->bindParam(':IDX',$IDX,PDO::PARAM_INT);
        $obtener->execute();
        $rs = $obtener->fetch(PDO::FETCH_ASSOC);
        $cedula = $rs['no_cedula'];
        $grado = $rs['grado'];
        $especialidad = $rs['especialidad'];
        $universidad = $rs['universidad'];
        $activar = $this->conexion->prepare("INSERT INTO medico(no_usuario,no_admon,no_cedula,grado,especialidad,universidad)
          VALUES (:usuario,:admon,:cedula,:grado,:especialidad,:universidad)");
        $activar->bindParam(':usuario',$IDX,PDO::PARAM_INT);
        $activar->bindParam(':admon',$this->admon_IDX,PDO::PARAM_STR);
        $activar->bindParam(':cedula',$cedula,PDO::PARAM_STR);
        $activar->bindParam(':grado',$grado,PDO::PARAM_STR);
        $activar->bindParam(':especialidad',$especialidad,PDO::PARAM_STR);
        $activar->bindParam(':universidad',$universidad,PDO::PARAM_STR);
        $activar->execute();
        $eliminar = $this->conexion->prepare("DELETE FROM medico_pendiente WHERE no_usuario = :IDX");
        $eliminar->bindParam(':IDX',$IDX,PDO::PARAM_INT);
        $eliminar->execute();
        $actualizar = $this->conexion->prepare("UPDATE usuario SET activo=1 WHERE id_usuario=:id");
        $actualizar->bindParam(':id',$IDX,PDO::PARAM_INT);
        $actualizar->execute();
    }
    function crear_medicamento($nombre,$informacion,$dosis,$via){
        $sentencia = $this->conexion->prepare("INSERT INTO medicamento(nombre,informacion,dosis,via_administracion)
              VALUES (:nombre,:informacion,:dosis,:via)");
        $sentencia->bindParam(':nombre',$nombre,PDO::PARAM_STR);
        $sentencia->bindParam(':informacion',$informacion,PDO::PARAM_STR);
        $sentencia->bindParam(':dosis',$dosis,PDO::PARAM_STR);
        $sentencia->bindParam(':via',$via,PDO::PARAM_STR);
        try{
            $sentencia->execute();
            return '{"exito":"1"}';
        }catch(PDOException $e){
            return '{"error":{"error":"ERROR"}}';
        }
    }
    function eliminar($IDX){
        $eliminar = $this->conexion->prepare("DELETE FROM usuario WHERE id_usuario = :IDX");
        $eliminar->bindParam(':IDX',$IDX,PDO::PARAM_INT);
        $eliminar->execute();
    }
}