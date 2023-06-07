<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Rol;
use Intervention\Image\ImageManagerStatic as Image;
use Model\AdminCita;
use Model\Canino;
use Model\UsuariosCita;

class UsuarioController {
    public static function index(Router $router) {

        $usuarios = Usuario::all();

        //Muestra mensaje condicional
        $resultado = $_GET["resultado"] ?? null;

        $router->render("usuarios/admin", [
            "usuarios"=>$usuarios,
            "resultado"=>$resultado
        ]);
    }

    public static function crear(Router $router) {
        $usuario = new Usuario;
        $roles = Rol::all();

        $errores = [];

        //Arreglo con mensaje de errores
        $errores = Usuario::getErrores();

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = new Usuario($_POST["usuario"]);

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if($_FILES["usuario"]["tmp_name"]["imagen"]) {
                $image = Image::make($_FILES["usuario"]["tmp_name"]["imagen"])->fit(800,600);
                $usuario->setImagen($nombreImagen);
            }

            $usuario->hashpassword();
            $errores = $usuario->validar();

            if(empty($errores)) {
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $usuario->guardarUsuario();
            }
        }

        $router->render("usuarios/crear", [
            "usuario"=>$usuario,
            "roles"=>$roles,
            "errores"=>$errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar("/usuarios/admin");
        $usuario = Usuario::find($id);
        $errores = Usuario::getErrores();
        $roles = Rol::all();

        if($_SERVER["REQUEST_METHOD"] === "POST") {

            //Asignar los atributos 
            $args = $_POST["usuario"];
            $usuario->sincronizar($args);
    
            //Validacion
            $errores = $usuario->validar();
    
            //Subida de archivos
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            if($_FILES["usuario"]["tmp_name"]["imagen"]) {
                $image = Image::make($_FILES["usuario"]["tmp_name"]["imagen"])->fit(800,600);
                $usuario->setImagen($nombreImagen);
            }
    
            //Revisar que el array de errores este vacio
            if (empty($errores)) {
                // Almacenar la imagen
                if($_FILES["usuario"]["tmp_name"]["imagen"]) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                $usuario->guardarUsuario();
            }
        }

        $router->render("usuarios/actualizar", [
            "usuario" => $usuario,
            "errores" => $errores,
            "roles" => $roles
        ]);
    }

    public static function eliminar() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            //Validar ID
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id) {
                $tipo = $_POST["tipo"];
    
                if(validarTipoContenido($tipo)) {
                    $usuario = Usuario::find($id);
                    
                    $usuario->eliminarUsuario();
                }
            }
        }
    }

    public static function cliente(Router $router) {

        if(!isset($_SESSION)) {
            session_start();
        }
        
        isAuth();
        $id = $_SESSION["id"];
        $caninos = Canino::caninos($id);
        $resultado = $_GET["resultado"] ?? null;
        //debuguear($caninos);

        $router->render("clientes/index", [
            "nombre"=>$_SESSION["nombre"],
            "id"=>$id,
            "caninos"=>$caninos,
            "resultado"=>$resultado
        ]);
    }

    public static function canino(Router $router) {
        $canino = new Canino;

        $errores = [];

        $errores = Canino::getErrores();
        $resultado = $_GET["resultado"] ?? null;

        if(!isset($_SESSION)) {
            session_start();
        }
        $id = $_SESSION["id"];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $canino = new Canino($_POST["canino"]);
            
            $errores = $canino->validarCanino();

            if(empty($errores)) {
                $canino->id();
                $canino->guardarCanino();
            }
        }

        $router->render("clientes/canino", [
            "id"=>$_SESSION["id"],
            "canino"=>$canino,
            "errores" => $errores,
            "resultado"=>$resultado
        ]);
    }

    public static function citasAdmin(Router $router) {

        $fecha = $_GET["fecha"] ?? date("Y-m-d");
        $fechas = explode("-", $fecha);

        if(!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header("Location: /404");
        }

        //Consultar la base de datos
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuario_id=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citaservicio ";
        $consulta .= " ON citaservicio.citaid=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citaservicio.servicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' ";

        $citas = AdminCita::SQL($consulta);

        $router->render("usuarios/citas", [
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }

    public static function citasCliente(Router $router) {
        
        if(!isset($_SESSION)) {
            session_start();
        }
        $id = $_SESSION["id"];

        $fecha = $_GET["fecha"] ?? date("Y-m-d");
        $fechas = explode("-", $fecha);

        if(!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header("Location: /404");
        }

        //Consultar la base de datos
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuario_id=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citaservicio ";
        $consulta .= " ON citaservicio.citaid=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citaservicio.servicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' AND citas.usuario_id =  '${id}' ";

        $citas = AdminCita::SQL($consulta);

        $router->render("clientes/citas", [
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }

    public static function veterinario(Router $router) {
        $fecha = $_GET["fecha"] ?? date("Y-m-d");
        $fechas = explode("-", $fecha);

        if(!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header("Location: /404");
        }

        $consulta = "SELECT citas.id, citas.hora, citas.canino, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuario_id=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citaservicio ";
        $consulta .= " ON citaservicio.citaid=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citaservicio.servicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' AND citaservicio.servicioid =  '1' ";

        $citas = UsuariosCita::SQL($consulta);

        $router->render("usuarios/veterinario", [
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }


    public static function peluquero(Router $router) {
        $fecha = $_GET["fecha"] ?? date("Y-m-d");
        $fechas = explode("-", $fecha);

        if(!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header("Location: /404");
        }

        $consulta = "SELECT citas.id, citas.hora, citas.canino, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuario_id=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citaservicio ";
        $consulta .= " ON citaservicio.citaid=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citaservicio.servicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' AND citaservicio.servicioid =  '2' ";

        $citas = UsuariosCita::SQL($consulta);

        $router->render("usuarios/peluquero", [
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }

    public static function hotelero(Router $router) {
        $fecha = $_GET["fecha"] ?? date("Y-m-d");
        $fechas = explode("-", $fecha);

        if(!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header("Location: /404");
        }

        $consulta = "SELECT citas.id, citas.hora, citas.canino, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuario_id=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citaservicio ";
        $consulta .= " ON citaservicio.citaid=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citaservicio.servicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' AND citaservicio.servicioid =  '3' ";

        $citas = UsuariosCita::SQL($consulta);

        $router->render("usuarios/hotelero", [
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }

    public static function instructor(Router $router) {
        $fecha = $_GET["fecha"] ?? date("Y-m-d");
        $fechas = explode("-", $fecha);

        if(!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header("Location: /404");
        }

        $consulta = "SELECT citas.id, citas.hora, citas.canino, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuario_id=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citaservicio ";
        $consulta .= " ON citaservicio.citaid=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citaservicio.servicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' AND citaservicio.servicioid =  '4' ";

        $citas = UsuariosCita::SQL($consulta);

        $router->render("usuarios/instructor", [
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }

    public static function actualizarCanino(Router $router) {
        $id = validarORedireccionar("/cliente");
        $canino = Canino::find($id);
        $errores = Canino::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            //Asignar los atributos 
            $args = $_POST["canino"];
            $canino->sincronizar($args);

            //Validacion
            $errores = $canino->validar();

            //Revisar que el array de errores este vacio
            if (empty($errores)) {
                // Almacenar la imagen
                $canino->guardarCanino();
            }

        }

        $router->render("clientes/actualizar", [
            "canino" => $canino,
            "errores" => $errores
        ]);
    }

    public static function eliminarCanino() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            //Validar ID
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id) {
    
                $tipo = $_POST["tipo"];
    
                if(validarTipoContenido($tipo)) {
                    $canino = Canino::find($id);
                    $canino->eliminarCanino();
                }
            }
        }
    }
}