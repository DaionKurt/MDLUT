<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 25/03/2017
 * Time: 08:35 AM
 */

namespace Entidades;

class Medico extends Usuario {

    private $no_cedula;
    private $id_m;
    private $id_a;
    private $horarios = array();
    /**
     * Medico constructor.
     * @param $nombre
     * @param $apellido
     * @param $sexo
     * @param $fecha_nacimiento
     * @param $telefono
     * @param $edad
     * @param $usuario
     * @param $correo
     * @param $pass
     * @param $activo
     * @param $no_cedula
     */
    public function __construct($nombre, $apellido, $sexo, $fecha_nacimiento, $telefono, $edad, $usuario,
                                $correo, $activo, $id, $no_cedula, $id_m, $id_a){
        parent::__construct($nombre, $apellido, $sexo, $fecha_nacimiento, $telefono, $edad, $usuario, $correo, $activo, $id);
        $this->set_no_cedula($no_cedula);
        $this->set_IdM($id_m);
        $this->set_IdA($id_a);
    }
    /**
     * @param mixed $no_cedula
     */
    public function set_no_cedula($no_cedula){
        $this->no_cedula = $no_cedula;
    }
    /**
     * @return mixed
     */
    public function get_no_cedula(){
        return $this->no_cedula;
    }
    /**
     * @return mixed
     */
    public function get_IdM(){
        return $this->id_m;
    }
    /**
     * @param mixed $id_m
     */
    public function set_IdM($id_m){
        $this->id_m = $id_m;
    }
    /**
     * @return mixed
     */
    public function get_IdA(){
        return $this->id_a;
    }
    /**
     * @param mixed $id_a
     */
    public function set_IdA($id_a){
        $this->id_a = $id_a;
    }
    public function agrega_horario($horario){
        $this->horarios[] = $horario;
    }
    public function elimina_horario($llave){
        unset($this->horarios[$llave]);
    }
    public function get_horario($llave){
        return $this->horarios[$llave];
    }
}