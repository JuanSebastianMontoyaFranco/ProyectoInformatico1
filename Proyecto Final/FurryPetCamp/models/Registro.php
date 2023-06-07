<?php

namespace Model;

class Registro extends ActiveRecord {
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "nombre", "apellido", "cedula",
    "imagen", "telefono", "email", "password", "rol_id"];

    public $id;
    public $nombre;
    public $apellido;
    public $cedula;
    public $imagen;
    public $telefono;
    public $email;
    public $password;
    public $rol_id;
    
    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->cedula = $args["cedula"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->rol_id = $args["rol_id"] ?? 6;
    }

    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "Debes colocar un nombre";
        }

        if(!$this->apellido) {
            self::$errores[] = "Debes colocar un apellido";
        }

        if(!$this->cedula) {
            self::$errores[] = "Debes colocar un numero de cedula";
        }
        if(strlen($this->cedula) < 7) {
            self::$errores[] = "La cédula debe tener entre 7 y 10 caracteres";
        }

        if(!$this->imagen) {
            self::$errores[] = "Debes colocar una imagen";
        }

        if(!$this->telefono) {
            self::$errores[] = "Debes colocar un telefono";
        }

        if(!$this->email) {
            self::$errores[] = "Debes colocar un email";
        }

        if(!$this->password) {
            self::$errores[] = "Debes colocar una contraseña";
        }

        /*if(strlen($this->password) < 6) {
            self::$errores[] = "El password debe tener al menos 6 caracteres";
        }*/
        return self::$errores;

    }

    public function hashpassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
}