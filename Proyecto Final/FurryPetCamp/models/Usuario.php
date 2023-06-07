<?php

namespace Model;

class Usuario extends ActiveRecord {
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
        $this->rol_id = $args["rol_id"] ?? "";
    }
    

    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "Debes colocar un nombre";
        }

        if(!$this->apellido) {
            self::$errores[] = "Debes colocar un apellido";
        }

        if(!$this->cedula) {
            self::$errores[]= "Debes colocar un numero de cedula";
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

        if(!$this->rol_id) {
            self::$errores[] = "Debes seleccionar un rol";
        }
        return self::$errores;
    }

    public function hashpassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function validarLogin() {
        if(!$this->email) {
            self::$errores["error"][] = "El Email es obligatorio";
        }

        if(!$this->password) {
            self::$errores["error"][] = "La contraseña es obligatoria";
        }

        return self::$errores;
    }

    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);
        
        if(!$resultado->num_rows){
            self::$errores["error"][] = "El usuario ya esta registrado";
            return;
        }
        return $resultado;

    }

    public function comprobarPassword($password) {
        $resultado = password_verify($password, $this->password);

        if(!$resultado) {
            self::$errores["error"][] = "El password es incorrecto";
        }else {
            return true;
        }
    }
}