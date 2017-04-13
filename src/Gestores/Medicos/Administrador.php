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
        $this->medico_IDX   = $medico;
        $this->usuario_IDX  = $usuario;
        $this->conexion     = get_connection_test();
    }
    function __destruct(){
        $this->conexion = null;
    }
    function get_citas(){
        $sentencia = $this->conexion->prepare("
              SELECT horario.hora,horario.dia,cita.anotaciones,paciente.estado_diabetico,usuario.nombre,usuario.apellido,
               usuario.edad, usuario.telefono FROM cita
              INNER JOIN paciente ON cita.no_paciente    = paciente.id_paciente
              INNER JOIN usuario  ON paciente.no_usuario = usuario.id_usuario
              INNER JOIN horario  ON cita.horario        = horario.id_horario
              INNER JOIN medico   ON medico.id_medico    = cita.no_medico
              WHERE medico.id_medico = :medico ORDER BY dia,hora");
        $sentencia->bindParam(':medico',$this->medico_IDX,PDO::PARAM_INT);

        try{
            $sentencia->execute();
            $salida = "";
            while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Hora":"'      .$rs["hora"]            .'",';
                $salida .= '"Dia":"'        .$rs["dia"]             .'",';
                $salida .= '"Anotaciones":"'.$rs["anotaciones"]     .'",';
                $salida .= '"Paciente":"'   .$rs["nombre"].' '.$rs["apellido"]     .'",';
                $salida .= '"Estado":"'     .$rs["estado_diabetico"].'",';
                $salida .= '"Edad":"'       .$rs["edad"]            .'",';
                $salida .= '"Telefono":"'   .$rs["telefono"]        .'"}';
            }
            $salida ='{"citas":['.$salida.']}';
            return $salida;
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function get_expedientes(){
        try{
            $max_paciente = "SELECT MAX(id_paciente) FROM paciente";
            $sentencia = $this->conexion->query($max_paciente);
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            $j         = intval($resultado['MAX(id_paciente)']);
            $salida = "";
            for($i=1;$i<=$j;++$i){
                $sentencia = "
                    SELECT diagnostico.estado,diagnostico.niv_glucosa,diagnostico.cat_glucosa,diagnostico.fecha,
                     diagnostico.porc_certeza,diagnostico.imc, usuario.nombre,usuario.apellido,usuario.sexo,
                     usuario.correo,usuario.edad,paciente.estado_diabetico FROM diagnostico
                    INNER JOIN paciente ON diagnostico.no_paciente = paciente.id_paciente
                    INNER JOIN usuario  ON paciente.no_usuario     = usuario.id_usuario
                    WHERE diagnostico.no_paciente = '$i' ORDER BY no_paciente,fecha";
                $result = $this->conexion->query($sentencia);
                $k = 1;
                $entre = false;
                while ($rs = $result->fetch(PDO::FETCH_ASSOC)) {
                    $entre = true;
                    if ($salida != "") {$salida .= ",";}
                    if ($k == 1) {
                        $salida .= '{"Nombre":"'. $rs["nombre"] . ' ' . $rs["apellido"] . '",';
                        $salida .= '"Correo":"' . $rs["correo"] . '",';
                        $salida .= '"Sexo":"'   . $rs["sexo"]   . '",';
                        $salida .= '"Edo":"'    . $rs["estado_diabetico"] . '",';
                        $salida .= '"Edad":"'   . $rs["edad"]   . '","Diagnosticos":[';
                        $k++;
                    }
                    $salida .= '{"Estado":"'    . $rs["estado"]         . '",';
                    $salida .= '"N_Glucosa":"'  . $rs["niv_glucosa"]    . '",';
                    $salida .= '"C_Glucosa":"'  . $rs["cat_glucosa"]    . '",';
                    $salida .= '"Fecha":"'      . $rs["fecha"]          . '",';
                    $salida .= '"Certeza":"'    . $rs["porc_certeza"]   . '",';
                    $salida .= '"IMC":"'        . $rs["imc"]            . '"}';
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
        $sentencia = $this->conexion->prepare("
              SELECT usuario.nombre,usuario.apellido,usuario.sexo,usuario.fecha_nacimiento,usuario.telefono,
               usuario.edad,usuario.usuario,usuario.correo, medico.no_cedula,medico.grado,medico.especialidad,medico.universidad
               FROM usuario INNER JOIN medico ON usuario.id_usuario=medico.no_usuario WHERE medico.id_medico = :medico");
        $sentencia->bindParam(':medico',$this->medico_IDX,PDO::PARAM_INT);
        try{
            $sentencia->execute();
            $salida = "";
            while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Nombre":"'    .$rs["nombre"]          .'",';
                $salida .= '"Apellido":"'   .$rs["apellido"]        .'",';
                $salida .= '"Sexo":"'       .$rs["sexo"]            .'",';
                $salida .= '"Fecha":"'      .$rs["fecha_nacimiento"].'",';
                $salida .= '"Telefono":"'   .$rs["telefono"]        .'",';
                $salida .= '"Edad":"'       .$rs["edad"]            .'",';
                $salida .= '"Usuario":"'    .$rs["usuario"]         .'",';
                $salida .= '"Correo":"'     .$rs["correo"]          .'",';
                $salida .= '"Cedula":"'     .$rs["no_cedula"]       .'",';
                $salida .= '"Grado":"'      .$rs["grado"]           .'",';
                $salida .= '"Especialidad":"'.$rs["especialidad"]   .'",';
                $salida .= '"Universidad":"'.$rs["universidad"]     .'"}';
            }
            return $salida;
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function get_horarios(){
        $sentencia = $this->conexion->prepare("SELECT horario.dia,horario.hora,horario.libre
                              FROM horario WHERE medico = :medico");
        $sentencia->bindParam(':medico',$this->medico_IDX,PDO::PARAM_INT);
        try{
            $sentencia->execute();
            $salida = "";
            while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Dia":"'   .$rs["dia"]     .'",';
                $salida .= '"Hora":"'   .$rs["hora"]    .'",';
                $salida .= '"Libre":"'  .$rs["libre"]   .'"}';
            }
            $salida ='{"horarios":['.$salida.']}';
            return $salida;
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function crear_horario($dia,$hora){
        $sentencia = $this->conexion->prepare("INSERT INTO Horario(medico,dia,hora) VALUES (:medico,:dia,:hora)");
        $sentencia->bindParam(':medico',$this->medico_IDX,PDO::PARAM_INT);
        $sentencia->bindParam(':dia',$dia,PDO::PARAM_STR);
        $sentencia->bindParam(':hora',$hora,PDO::PARAM_STR);
        try{
            $sentencia->execute();
            return '{"exito":1}';
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
}