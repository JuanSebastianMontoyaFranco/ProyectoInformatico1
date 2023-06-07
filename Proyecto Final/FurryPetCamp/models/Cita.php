<?php
namespace Model;

class Cita extends ActiveRecord {
    //Base de datos
    protected static $tabla = "citas";
    protected static $columnasDB = ["id", "fecha", "hora", "canino",  "usuario_id"];
    
    public $id;
    public $fecha;
    public $hora;
    public $canino;
    public $usuario_id;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->fecha = $args["fecha"] ?? "";
        $this->hora = $args["hora"] ?? "";
        $this->canino = $args["canino"] ?? "";
        $this->usuario_id = $args["usuario_id"] ?? "";
    }
}