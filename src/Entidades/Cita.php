<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 25/03/2017
 * Time: 08:36 AM
 */

namespace Entidades;

class Cita{

    private $id;
    private $id_m;
    private $id_p;
    private $id_h;
    private $anotaciones;

    /**
     * Cita constructor.
     * @param $id
     * @param $id_m
     * @param $id_p
     * @param $id_h
     * @param $anotaciones
     */
    public function __construct($id, $id_m, $id_p, $id_h, $anotaciones){
        $this->id = $id;
        $this->id_m = $id_m;
        $this->id_p = $id_p;
        $this->id_h = $id_h;
        $this->anotaciones = $anotaciones;
    }

    /**
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function setId($id){
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getIdM(){
        return $this->id_m;
    }
    /**
     * @param mixed $id_m
     */
    public function setIdM($id_m){
        $this->id_m = $id_m;
    }
    /**
     * @return mixed
     */
    public function getIdP(){
        return $this->id_p;
    }
    /**
     * @param mixed $id_p
     */
    public function setIdP($id_p){
        $this->id_p = $id_p;
    }
    /**
     * @return mixed
     */
    public function getIdH(){
        return $this->id_h;
    }
    /**
     * @param mixed $id_h
     */
    public function setIdH($id_h){
        $this->id_h = $id_h;
    }
    /**
     * @return mixed
     */
    public function getAnotaciones(){
        return $this->anotaciones;
    }
    /**
     * @param mixed $anotaciones
     */
    public function setAnotaciones($anotaciones){
        $this->anotaciones = $anotaciones;
    }
}