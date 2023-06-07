<?php

namespace Model;

class ActiveRecord {

    //Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = "";

    //Errores
    protected static $errores = [];

    //Definir la conexion a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }

    public function guardar() {
        if(!is_null($this->id)) {
            //Actualizar
            $this->actualizar();
        }else {
            //Creando un nuevo registro
            $this->crear();
        }
    }

    public function guardarCita() {
        $resultado = "";
        if(!is_null($this->id)) {
            //Actualizar
            $resultado = $this->actualizar();
        }else {
            //Creando un nuevo registro
            $resultado = $this->crearCita();
        }
        return $resultado;
    }

    public function guardarRegistro() {
        if(!is_null($this->id)) {
            //Actualizar
            $this->actualizar();
        }else {
            //Creando un nuevo registro
            $this->crearRegistro();
        }
    }

    public function guardarUsuario() {
        if(!is_null($this->id)) {
            //Actualizar
            $this->actualizarUsuario();
        }else {
            //Creando un nuevo registro
            $this->crearUsuario();
        }
    }

    public function guardarCanino() {
        if(!is_null($this->id)) {
            //Actualizar
            $this->actualizarCanino();
        }else {
            //Creando un nuevo registro
            $this->crearCanino();
        }
    }


    public function crear() {
        //Santitizar los datos
        $atributos = $this->sanitizarAtributos();

        $string = join(',', array_values($atributos));

        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla  . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        //Mensaje de exito o error
        if($resultado) {
            //Redireccionar al usuario
            header("Location: /admin?resultado=1");

        }
    }

    public function crearCita() {
        //Santitizar los datos
        $atributos = $this->sanitizarAtributos();

        $string = join(',', array_values($atributos));

        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla  . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        return [
            "resultado" => $resultado,
            "id"=> self::$db->insert_id
        ];
    }

    public function crearUsuario() {
        //Santitizar los datos
        $atributos = $this->sanitizarAtributos();

        $string = join(',', array_values($atributos));

        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla  . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        //Mensaje de exito o error
        if($resultado) {
            //Redireccionar al usuario
            header("Location: /usuarios/admin?resultado=1");

        }
    }

    public function crearCanino() {
        //Santitizar los datos
        $atributos = $this->sanitizarAtributos();

        $string = join(',', array_values($atributos));

        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla  . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        //Mensaje de exito o error
        if($resultado) {
            //Redireccionar al usuario
            header("Location: /cliente/canino?resultado=1");

        }
    }

    public function crearRegistro() {
        //Santitizar los datos
        $atributos = $this->sanitizarAtributos();

        $string = join(',', array_values($atributos));

        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla  . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        //Mensaje de exito o error
        if($resultado) {
            //Redireccionar al usuario
            header("Location: /registro?resultado=4");

        }
    }

    public function actualizar() {
        //Santitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        //Insertar en la base de datos
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado) {
            //Redireccionar al usuario
            header("Location: /admin?resultado=2");
        }
    }

    public function actualizarUsuario() {
        //Santitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        //Insertar en la base de datos
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado) {
            //Redireccionar al usuario
            header("Location: /usuarios/admin?resultado=2");
        }
    }

    public function actualizarCanino() {
        //Santitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        //Insertar en la base de datos
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado) {
            //Redireccionar al usuario
            header("Location: /cliente?resultado=2");
        }
    }

    public function eliminar() {
        //Eliminar el resgitro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " .self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header("Location: /admin?resultado=3");
        }
    }

    public function eliminarUsuario() {
        //Eliminar el resgitro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " .self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header("Location: /usuarios/admin?resultado=3");
        }
    }

    public function eliminarCanino() {
        //Eliminar el resgitro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " .self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            header("Location: /cliente?resultado=3");
        }
    }

    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] =  self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen) {
        //Elimina la imagen previa
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }
        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar archivo
    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //Validacion
    public static function getErrores() {
        return static::$errores;
    }

    public static function setErrores($tipo, $mensaje) {
        static::$errores[$tipo][] = $mensaje;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    //Lista todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Obtiene determinados numeros de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Buscar una propiedad por su ID
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id= ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query) {
        //Consultar la Base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        //Liberar la memoria 
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function caninos($id) {
        $query = "SELECT * FROM caninos WHERE caninos.usuario_id = $id";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Consulta plana de sql 
    public static function SQL($query) {
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public function eliminarVeterinario() {
        //Eliminar el resgitro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " .self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header("Location: /veterinario?resultado=3");
        }
    }

    public function eliminarHotelero() {
        //Eliminar el resgitro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " .self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header("Location: /hotelero?resultado=3");
        }
    }

    public function eliminarInstructor() {
        //Eliminar el resgitro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " .self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header("Location: /instructor?resultado=3");
        }
    }

    public function eliminarPeluquero() {
        //Eliminar el resgitro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " .self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header("Location: /peluquero?resultado=3");
        }
    }

    




}