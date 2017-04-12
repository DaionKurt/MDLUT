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
    private $medico_IDX;
    private $usuario_IDX;

    function __construct($medico,$usuario){
        $this->medico_IDX = $medico;
        $this->usuario_IDX = $usuario;
        $this->conexion = get_connection_test();
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    function __destruct(){
        $this->conexion = null;
    }
    function get_citas(){
        $medico = $this->medico_IDX;
        $sql = "SELECT * FROM cita
              INNER JOIN paciente ON cita.no_paciente = paciente.id_paciente
              INNER JOIN usuario ON paciente.no_usuario = usuario.id_usuario
              INNER JOIN horario ON cita.horario = horario.id_horario
              INNER JOIN medico ON medico.id_medico = cita.no_medico
              WHERE medico.id_medico = '$medico';";
        try{
            $result=$this->conexion->query($sql);
            $salida = "";
            while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Hora":"' .$rs["hora"]   .'",';
                $salida .= '"Dia":"'     .$rs["dia"] .'",';
                $salida .= '"Anotaciones":"' .$rs["anotaciones"]     .'",';
                $salida .= '"Paciente":"'   .$rs["nombre"].' '.$rs["apellido"]     .'",';
                $salida .= '"Estado":"'   .$rs["estado_diabetico"]     .'",';
                $salida .= '"Edad":"'   .$rs["edad"]     .'",';
                $salida .= '"Telefono":"' .$rs["telefono"]     .'"}';
            }
            $salida ='{"citas":['.$salida.']}';
            return $salida;
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function get_expedientes(){
        try {
            $max_medico = "SELECT MAX(id_paciente) FROM paciente";
            $ja=$this->conexion->query($max_medico);
            $je = $ja->fetch(PDO::FETCH_ASSOC);
            $j = intval($je['MAX(id_paciente)']);
            $salida = "";
            for($i=1;$i<=$j;++$i){
                $sql = "SELECT * FROM diagnostico
            INNER JOIN paciente ON diagnostico.no_paciente = paciente.id_paciente
            INNER JOIN usuario ON paciente.no_usuario = usuario.id_usuario
            WHERE diagnostico.no_paciente = '$i'
            ORDER BY no_paciente;";
                $result = $this->conexion->query($sql);
                $k = 1;
                $entre = false;
                while ($rs = $result->fetch(PDO::FETCH_ASSOC)) {
                    $entre = true;
                    if ($salida != "") {
                        $salida .= ",";
                    }
                    if ($k == 1) {
                        $salida .= '{"Nombre":"' . $rs["nombre"] . ' ' . $rs["apellido"] . '",';
                        $salida .= '"Edad":"' . $rs["edad"] . '","Diagnosticos":[';
                        $k++;
                    }
                    $salida .= '{"Estado":"' . $rs["estado"] . '",';
                    $salida .= '"IMC":"' . $rs["imc"] . '"}';
                }
                if ($entre) $salida .= "]}";
            }

            $string ='{"pacientes":['.$salida.']}';
            return $string;
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function get_informacion(){
        $sql = "SELECT * FROM usuario INNER JOIN medico ON usuario.id_usuario=medico.no_usuario AND usuario.id_usuario= '$this->usuario_IDX'";
        try{
            $result=$this->conexion->query($sql);
            $salida = "";
            while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Nombre":"' .$rs["nombre"]   .'",';
                $salida .= '"Apellido":"'.$rs["apellido"] .'",';
                $salida .= '"Sexo":"'    .$rs["sexo"]     .'",';
                $salida .= '"Fecha":"'   .$rs["fecha_nacimiento"]     .'",';
                $salida .= '"Telefono":"'.$rs["telefono"]     .'",';
                $salida .= '"Edad":"'    .$rs["edad"]     .'",';
                $salida .= '"Usuario":"' .$rs["usuario"]     .'",';
                $salida .= '"Correo":"'  .$rs["correo"]     .'",';
                $salida .= '"Cedula":"'  .$rs["no_cedula"]     .'",';
                $salida .= '"Grado":"'   .$rs["grado"]     .'",';
                $salida .= '"Especialidad":"'.$rs["especialidad"]     .'",';
                $salida .= '"Universidad":"'.$rs["universidad"]   .'"}';
            }
            return $salida;
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function get_horarios(){
        $sql = "SELECT * FROM horario WHERE medico='$this->medico_IDX'";
        try{
            $result=$this->conexion->query($sql);
            $salida = "";
            while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Dia":"'.$rs["dia"] .'",';
                $salida .= '"Hora":"'        .$rs["hora"]     .'",';
                $salida .= '"Libre":"'       .$rs["libre"]     .'"}';
            }
            $salida ='{"horarios":['.$salida.']}';
            return $salida;
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function crear_horario($dia,$hora){
        $sql = "INSERT INTO Horario(medico,dia,hora) VALUES ('$this->medico_IDX','$dia','$hora');";
        try{
            $stmt = $this->conexion->query($sql);
            return '{"exito":1}';
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
}