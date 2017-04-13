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
    private $paciente_IDX;
    private $usuario_IDX;

    function __construct($paciente,$usuario){
        $this->paciente_IDX = $paciente;
        $this->usuario_IDX  = $usuario;
        $this->conexion     = get_connection_test();
    }
    function __destruct(){
        $this->conexion = null;
    }
    function get_datos_grafico(){
        $sentencia = $this->conexion->prepare("SELECT diagnostico.imc,diagnostico.niv_glucosa
                FROM diagnostico WHERE diagnostico.no_paciente = :paciente");
        $elementos = '{"cols": [
                {"id":"","label":"DX","pattern":"","type":"string"},
                {"id":"","label":"Glucosa","pattern":"","type":"number"},
                {"id":"","label":"IMC","pattern":"","type":"number"}
              ],"rows": [';
        try{
            $sentencia->execute([':paciente' => $this->paciente_IDX]);
            $contenido = "";
            $i=1;
            while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                if ($contenido != "") {$contenido .= ",";}
                $contenido .='{"c":[{"v":"DX'.$i.'","f":null},{"v":'.$rs["niv_glucosa"].',"f":null},{"v":'.$rs["imc"].',"f":null}]}';
                $i++;
            }
            $elementos.=$contenido.']}';
            return $elementos;
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function get_citas(){
        $sentencia = $this->conexion->prepare("
        SELECT horario.dia,horario.hora,cita.anotaciones,usuario.nombre,usuario.apellido,medico.no_cedula FROM Usuario 
        INNER JOIN Medico   ON Usuario.id_usuario = Medico.no_usuario 
        INNER JOIN Cita     ON cita.no_medico     = Medico.id_medico 
        INNER JOIN Horario  ON horario.id_horario = cita.horario 
        WHERE cita.no_paciente = :paciente");
        $sentencia->bindParam(':paciente',$this->paciente_IDX,PDO::PARAM_INT);
        $max_medico = "SELECT MAX(id_medico) FROM Medico";
        try{
            $sentencia->execute();
            $salida = "";
            while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Anotaciones":"'.$rs["anotaciones"] .'",';
                $salida .= '"Dia":"'        .$rs["dia"]     .'",';
                $salida .= '"Hora":"'       .$rs["hora"]     .'",';
                $salida .= '"Medico":"'     .$rs["nombre"]." ".$rs["apellido"]    .'",';
                $salida .= '"Cedula":"'     .$rs["no_cedula"].'"}';
            }
            $salida ='{"citas":['.$salida.'],';

            $sentencia  = $this->conexion->query($max_medico);
            $resultado  = $sentencia->fetch(PDO::FETCH_ASSOC);
            $j          = intval($resultado['MAX(id_medico)']);
            $out = "";
            for($i=1;$i<=$j;++$i){
                $result=$this->conexion->query("
                  SELECT horario.dia,horario.hora,horario.id_horario,usuario.nombre,usuario.apellido,medico.no_cedula,
                  medico.universidad,medico.especialidad,medico.id_medico FROM Horario 
                  INNER JOIN Medico   ON medico.id_medico   = horario.medico 
                  INNER JOIN Usuario  ON usuario.id_usuario = medico.no_usuario 
                  WHERE medico.id_medico = '$i' AND horario.libre = 1;");
                $k = 1;
                $entre = false;
                while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
                    $entre = true;
                    if ($out != "") {$out .= ",";}
                    if($k==1){
                        $out .= '{"Nombre":"'.$rs["nombre"] .' '.$rs["apellido"] .'",';
                        $out .= '"Universidad":"'.$rs["universidad"] .'",';
                        $out .= '"Especialidad":"'.$rs["especialidad"] .'",';
                        $out .= '"ND":"'.$rs["id_medico"] .'",';
                        $out .= '"Cedula":"'        .$rs["no_cedula"]     .'","horarios":[';
                        $k++;
                    }
                    $out .= '{"Fecha":"'        .$rs["dia"]." - ".$rs["hora"]     .'",';
                    $out .= '"ND":"'        .$rs["id_horario"]     .'"}';
                }
                if($entre) $out .= "]}";
            }
            $salida .='"medicos":['.$out.']}';
            return $salida;
        }catch(PDOException $e){
            return  '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function get_diagnosticos(){
        $sentencia = $this->conexion->prepare("
          SELECT diagnostico.estado,diagnostico.imc,diagnostico.fecha,diagnostico.niv_glucosa,diagnostico.cat_glucosa,
          diagnostico.porc_certeza FROM Diagnostico 
          INNER JOIN Paciente WHERE Diagnostico.no_paciente = :paciente AND Paciente.id_paciente = :paciente_s");
        $sentencia->bindParam(':paciente'  ,$this->paciente_IDX,PDO::PARAM_INT);
        $sentencia->bindParam(':paciente_s',$this->paciente_IDX,PDO::PARAM_INT);
        try{
            $sentencia->execute();
            $salida = "";
            while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Estado":"' .$rs["estado"]         .'",';
                $salida .= '"IMC":"'     .$rs["imc"]            .'",';
                $salida .= '"Fecha":"'   .$rs["fecha"]          .'",';
                $salida .= '"Glucosa":"' .$rs["niv_glucosa"]    .'",';
                $salida .= '"Cat_g":"'   .$rs["cat_glucosa"]    .'",';
                $salida .= '"Certeza":"' .$rs["porc_certeza"]   .'"}';
            }
            $salida ='{"diagnosticos":['.$salida.']}';
            return $salida;
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function get_informacion(){
        $sentencia = $this->conexion->prepare("
          SELECT usuario.nombre,usuario.apellido,usuario.sexo,usuario.fecha_nacimiento,usuario.telefono,
               usuario.edad,usuario.usuario,usuario.correo,paciente.estado_diabetico FROM usuario 
          INNER JOIN paciente ON usuario.id_usuario=paciente.no_usuario AND usuario.id_usuario = :usuario");
        $sentencia->bindParam(':usuario',$this->usuario_IDX,PDO::PARAM_INT);
        try{
            $sentencia->execute();
            $salida = "";
            while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Nombre":"' .$rs["nombre"]   .'",';
                $salida .= '"Apellido":"'.$rs["apellido"] .'",';
                $salida .= '"Sexo":"'    .$rs["sexo"]     .'",';
                $salida .= '"Fecha":"'   .$rs["fecha_nacimiento"]     .'",';
                $salida .= '"Telefono":"'.$rs["telefono"]     .'",';
                $salida .= '"Edad":"'    .$rs["edad"]     .'",';
                $salida .= '"Usuario":"' .$rs["usuario"]     .'",';
                $salida .= '"Correo":"'  .$rs["correo"]     .'",';
                $salida .= '"Estado":"'  .$rs["estado_diabetico"]   .'"}';
            }
            return $salida;
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function get_medicamentos(){
        $sentencia_r = $this->conexion->prepare("SELECT receta.descripcion,receta.fecha_expedicion,receta.fecha_limite
                                    FROM receta WHERE receta.no_paciente = :paciente");
        $sentencia_r->bindParam(':paciente',$this->paciente_IDX,PDO::PARAM_INT);
        $sentencia_m = $this->conexion->prepare("
        SELECT DISTINCT(medicamento.nombre),medicamento.informacion,medicamento.dosis,medicamento.via_administracion FROM medicamento 
        INNER JOIN Medicamento_Recetado ON medicamento.id_medicamento     = medicamento_recetado.id_medicamento 
        INNER JOIN Receta               ON medicamento_recetado.id_receta = receta.id_receta 
        WHERE receta.no_paciente = :paciente");
        $sentencia_m->bindParam(':paciente',$this->paciente_IDX,PDO::PARAM_INT);

        try{
            $sentencia_r->execute();
            $salida = "";
            while($rs = $sentencia_r->fetch(PDO::FETCH_ASSOC)) {
                if ($salida != "") {$salida .= ",";}
                $salida .= '{"Descripcion":"'       .$rs["descripcion"]         .'",';
                $salida .= '"Fecha_expediente":"'   .$rs["fecha_expedicion"]    .'",';
                $salida .= '"Fecha_limite":"'       .$rs["fecha_limite"]        .'"}';
            }
            $salida ='{"recetas":['.$salida.'],';
            $sentencia_m->execute();
            $out = "";
            while($rs = $sentencia_m->fetch(PDO::FETCH_ASSOC)) {
                if ($out != "") {$out .= ",";}
                $out .= '{"Medicamento":"'.$rs["nombre"]            .'",';
                $out .= '"Informacion":"' .$rs["informacion"]       .'",';
                $out .= '"Dosis":"'       .$rs["dosis"]             .'",';
                $out .= '"Via":"'         .$rs["via_administracion"].'"}';
            }
            $salida .='"medicamentos":['.$out.']}';
            return $salida;
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
    function crear_cita($medico,$horario,$anotaciones){
        $actualizacion = $this->conexion->prepare("UPDATE Horario SET libre = 0 WHERE id_horario = :horario");
        $actualizacion->bindParam(':horario',$horario,PDO::PARAM_STR);
        $sentencia = $this->conexion->prepare("INSERT INTO Cita(no_medico,no_paciente,horario,anotaciones)
              VALUES (:medico,:paciente,:horario,:anotaciones)");
        $sentencia->bindParam(':medico'     ,$medico,               PDO::PARAM_INT);
        $sentencia->bindParam(':paciente'   ,$this->paciente_IDX,   PDO::PARAM_INT);
        $sentencia->bindParam(':horario'    ,$horario,              PDO::PARAM_INT);
        $sentencia->bindParam(':anotaciones',$anotaciones,          PDO::PARAM_INT);
        try{
            $actualizacion->execute();
            $sentencia->execute();
            return '{"exito":1}';
        }catch(PDOException $e){
            return '{"error":{"error":'. $e->getMessage() .'}}';
        }
    }
}