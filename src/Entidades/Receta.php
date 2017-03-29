<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 25/03/2017
 * Time: 08:35 AM
 */

namespace Entidades;

class Receta{

    private $id;
    private $descripcion;
    private $fecha_expedicion;
    private $fecha_limite;
    private $id_m;
    private $id_p;

    /**
     * Receta constructor.
     * @param $id
     * @param $descripcion
     * @param $fecha_expedicion
     * @param $fecha_limite
     * @param $id_m
     * @param $id_p
     */
    public function __construct($id, $descripcion, $fecha_expedicion, $fecha_limite, $id_m, $id_p){
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->fecha_expedicion = $fecha_expedicion;
        $this->fecha_limite = $fecha_limite;
        $this->id_m = $id_m;
        $this->id_p = $id_p;
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
    public function getDescripcion(){
        return $this->descripcion;
    }
    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    /**
     * @return mixed
     */
    public function getFechaExpedicion(){
        return $this->fecha_expedicion;
    }
    /**
     * @param mixed $fecha_expedicion
     */
    public function setFechaExpedicion($fecha_expedicion){
        $this->fecha_expedicion = $fecha_expedicion;
    }
    /**
     * @return mixed
     */
    public function getFechaLimite(){
        return $this->fecha_limite;
    }
    /**
     * @param mixed $fecha_limite
     */
    public function setFechaLimite($fecha_limite){
        $this->fecha_limite = $fecha_limite;
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

}