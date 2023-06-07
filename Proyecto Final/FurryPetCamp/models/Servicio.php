<?php

namespace Model;

class Servicio extends ActiveRecord {
    protected static $tabla = "servicios";
    protected static $columnasDB = ["id", "nombre", "precio", "imagen", 
    "descripcion", "creado"];

    public $id;
    public $nombre;
    public $precio;
    public $imagen;
    public $descripcion;
    public $creado;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->creado = date("Y/m/d");
    }

    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "Debes de colocar un nombre";
        }

        if(!$this->precio) {
            self::$errores[] = "Debes de colocar un precio";
        }

        if(!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        if(!$this->descripcion) {
            self::$errores[] = "Debes de colocar una descripcion";
        }
        return self::$errores;
    }
}