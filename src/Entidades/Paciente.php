<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 25/03/2017
 * Time: 08:35 AM
 */

namespace Entidades;

class Paciente extends Usuario implements \JsonSerializable {

    private $estado_diabetico;
    private $id_p;

    /**
     * Paciente constructor.
     * @param $nombre
     * @param $apellido
     * @param $sexo
     * @param $fecha_nacimiento
     * @param $telefono
     * @param $edad
     * @param $usuario
     * @param $correo
     * @param $activo
     * @param $estado_diabetico
     */
    public function __construct($nombre, $apellido, $sexo, $fecha_nacimiento, $telefono, $edad, $usuario,
                                $correo, $activo, $id,$estado_diabetico,$id_p){
        parent::__construct($nombre, $apellido, $sexo, $fecha_nacimiento, $telefono, $edad, $usuario, $correo, $activo, $id);
        $this->set_estado_diabetico($estado_diabetico);
        $this->set_idP($id_p);
    }
    /**
     * @param $estado_diabetico
     */
    public function set_estado_diabetico($estado_diabetico){
        $this->estado_diabetico = $estado_diabetico;
    }
    /**
     * @return mixed
     */
    public function get_estado_diabetico(){
        return $this->estado_diabetico;
    }
    /**
     * @return mixed
     */
    public function get_idP(){
        return $this->id_p;
    }
    /**
     * @param mixed $id
     */
    public function set_idP($id_p){
        $this->id_p = $id_p;
    }
    public function str(){
        return $this->get_nombre()." ".$this->get_apellido()." ".$this->get_edad();
    }
    public function jsonSerialize () {
        return parent::jsonSerialize()+ array(
            'estado_diabetico'=>$this->estado_diabetico
        );
    }
}