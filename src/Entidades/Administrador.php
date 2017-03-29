<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 25/03/2017
 * Time: 08:35 AM
 */

namespace Entidades;

class Administrador extends Usuario{

    private $id_ad;
    private $clave;

    /**
     * Administrador constructor.
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
     * @param $id
     * @param $clave
     * @param $id_ad
     */
    public function __construct($nombre, $apellido, $sexo, $fecha_nacimiento, $telefono, $edad, $usuario,
                                $correo, $pass, $activo, $id, $clave, $id_ad){
        parent::__construct($nombre, $apellido, $sexo, $fecha_nacimiento, $telefono, $edad, $usuario, $correo, $pass, $activo, $id);
        $this->set_clave($clave);
        $this->set_IdAd($id_ad);
    }
    /**
     * @return mixed
     */
    public function get_IdAd(){
        return $this->id_ad;
    }
    /**
     * @param mixed $id_ad
     */
    public function set_IdAd($id_ad){
        $this->id_ad = $id_ad;
    }
    /**
     * @return mixed
     */
    public function get_clave(){
        return $this->clave;
    }
    /**
     * @param mixed $clave
     */
    public function set_clave($clave){
        $this->clave = $clave;
    }
}