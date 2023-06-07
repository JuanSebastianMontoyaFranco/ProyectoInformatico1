<?php

namespace Model;

class UsuariosCita extends ActiveRecord {
    protected static $tabla = "citaservicio";
    protected static $columnasDB = ["id", "hora", "canino", "cliente", "email", 
    "telefono", "servicio", "precio"];

    public $id;
    public $hora;
    public $canino;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct()
    {
        $this->id = $args["id"] ?? null;
        $this->hora = $args["hora"] ?? "";
        $this->canino = $args["canino"] ?? "";
        $this->cliente = $args["cliente"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->servicio = $args["servicio"] ?? "";
        $this->precio = $args["precio"] ?? "";
    }
}