<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 25/03/2017
 * Time: 09:43 AM
 */

namespace Entidades;

class Horario{

    private $id;
    private $hora;
    private $dia;
    private $id_m;
    private $id_h;

    /**
     * Horario constructor.
     * @param $hora
     * @param $dia
     * @param $id_m
     * @param $id_h
     */
    function __construct($id,$hora, $dia, $id_m, $id_h){
        $this->set_id($id);
        $this->set_hora($hora);
        $this->set_dia($dia);
        $this->set_IdM($id_m);
        $this->set_IdH($id_h);
    }

    /**
    * @return mixed
    */
    public function get_id(){
        return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function set_id($id){
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function get_hora(){
        return $this->hora;
    }
    /**
     * @param mixed $hora
     */
    public function set_hora($hora){
        $this->hora = $hora;
    }
    /**
     * @return mixed
     */
    public function get_dia(){
        return $this->dia;
    }
    /**
     * @param mixed $dia
     */
    public function set_dia($dia){
        $this->dia = $dia;
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
    public function get_IdH(){
        return $this->id_h;
    }
    /**
     * @param mixed $id_h
     */
    public function set_IdH($id_h){
        $this->id_h = $id_h;
    }
}