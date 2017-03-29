<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 25/03/2017
 * Time: 08:36 AM
 */

namespace Entidades;

class Medicamento{

    private $id_me;
    private $nombre;
    private $descripcion;
    private $dosis;
    private $via_administracion;

    /**
     * Medicamento constructor.
     * @param $id_me
     * @param $nombre
     * @param $descripcion
     * @param $dosis
     * @param $via_administracion
     */
    public function __construct($id_me, $nombre, $descripcion, $dosis, $via_administracion){
        $this->id_me = $id_me;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->dosis = $dosis;
        $this->via_administracion = $via_administracion;
    }
    /**
     * @return mixed
     */
    public function getIdMe(){
        return $this->id_me;
    }
    /**
     * @param mixed $id_me
     */
    public function setIdMe($id_me){
        $this->id_me = $id_me;
    }
    /**
     * @return mixed
     */
    public function getNombre(){
        return $this->nombre;
    }
    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre){
        $this->nombre = $nombre;
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
    public function getDosis(){
        return $this->dosis;
    }
    /**
     * @param mixed $dosis
     */
    public function setDosis($dosis){
        $this->dosis = $dosis;
    }
    /**
     * @return mixed
     */
    public function getViaAdministracion(){
        return $this->via_administracion;
    }
    /**
     * @param mixed $via_administracion
     */
    public function setViaAdministracion($via_administracion){
        $this->via_administracion = $via_administracion;
    }


}