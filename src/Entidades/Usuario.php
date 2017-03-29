<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 25/03/2017
 * Time: 08:35 AM
 */

namespace Entidades;

abstract class Usuario implements \JsonSerializable {
    private $nombre;
    private $apellido;
    private $sexo;
    private $fecha_nacimiento;
    private $telefono;
    private $edad;
    private $usuario;
    private $correo;
    protected $activo;
    private $id;

    /**
     * Usuario constructor.
     * @param $nombre
     * @param $apellido
     * @param $sexo
     * @param $fecha_nacimiento
     * @param $telefono
     * @param $edad
     * @param $usuario
     * @param $correo
     * @param $activo
     */
    public function __construct($nombre, $apellido, $sexo, $fecha_nacimiento, $telefono, $edad, $usuario, $correo, $activo,$id){
        $this->set_nombre($nombre);
        $this->set_apellido($apellido);
        $this->set_sexo($sexo);
        $this->set_fecha_nacimiento($fecha_nacimiento);
        $this->set_telefono($telefono);
        $this->set_edad($edad);
        $this->set_usuario($usuario);
        $this->set_correo($correo);
        $this->set_activo($activo);
        $this->set_id($id);
    }

    public function get_nombre(){
        return $this->nombre;
    }
    public function set_nombre($nombre){
        $this->nombre = $nombre;
    }
    public function get_apellido(){
        return $this->apellido;
    }
    public function set_apellido($apellido){
        $this->apellido = $apellido;
    }
    public function get_sexo(){
        return $this->sexo;
    }
    public function set_sexo($sexo){
        $this->sexo = $sexo;
    }
    public function get_fecha_nacimiento(){
        return $this->fecha_nacimiento;
    }
    public function set_fecha_nacimiento($fecha_nacimiento){
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
    public function get_telefono(){
        return $this->telefono;
    }
    public function set_telefono($telefono){
        $this->telefono = $telefono;
    }
    public function get_edad(){
        return $this->edad;
    }
    public function set_edad($edad){
        $this->edad = $edad;
    }
    public function get_usuario(){
        return $this->usuario;
    }
    public function set_usuario($usuario){
        $this->usuario = $usuario;
    }
    public function get_correo(){
        return $this->correo;
    }
    public function set_correo($correo){
        $this->correo = $correo;
    }
    public function get_activo(){
        return $this->activo;
    }
    public function set_activo($activo){
        $this->activo = $activo;
    }
    public function get_id(){
        return $this->id;
    }
    public function set_id($id){
        $this->id = $id;
    }
    public function jsonSerialize () {
        return array(
            'nombre'=>$this->nombre,
            'apellido'=>$this->apellido,
            'sexo'=>$this->sexo,
            'fecha_nacimiento'=>$this->fecha_nacimiento,
            'telefono'=>$this->telefono,
            'edad'=>$this->edad,
            'usuario'=>$this->usuario,
            'correo'=>$this->correo
    );
}
}