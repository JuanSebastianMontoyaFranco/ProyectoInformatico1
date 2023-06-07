<?php

namespace Model;

class Canino extends ActiveRecord {
    protected static $tabla = "caninos";
    protected static $columnasDB = ["id", "nombre","raza" ,"edad", "descripcion", 
    "usuario_id"];

    public $id;
    public $nombre;
    public $raza;
    public $edad;
    public $descripcion;
    public $usuario_id;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->raza = $args["raza"] ?? "";
        $this->edad = $args["edad"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->usuario_id = $args["usuario_id"] ?? "";
    }

    public function validarCanino() {
        if(!$this->nombre) {
            self::$errores[] = "Debes colocar el nombre de la mascota";
        }
        if(!$this->raza) {
            self::$errores[] = "Debes colocar la raza de la mascota";
        }
        if(!$this->edad) {
            self::$errores[] = "Debes colocar la edad de la mascota";
        }
        return self::$errores;
    }

    public function id() {
        if(!isset($_SESSION)) {
            session_start();
        }
        $id = $_SESSION["id"];
        $this->usuario_id = $id;
    }

}