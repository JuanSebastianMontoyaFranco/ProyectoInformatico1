<?php

namespace Controllers;
use MVC\Router;
use Model\Servicio;
use Model\Rol;
use Intervention\Image\ImageManagerStatic as Image;

class ServicioController {
    public static function index(Router $router) {
        $servicios = Servicio::all();

        //Muestra mensaje condicional
        $resultado = $_GET["resultado"] ?? null;

        $router->render("servicios/admin", [
            "servicios"=>$servicios,
            "resultado"=>$resultado
        ]);
    }

    public static function crear(Router $router) {
        $servicio = new Servicio;
        $roles = Rol::all();

        //Arreglo con mensaje de errores
        $errores = Servicio::getErrores();

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $servicio = new Servicio($_POST["servicio"]);

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if($_FILES["servicio"]["tmp_name"]["imagen"]) {
                $image = Image::make($_FILES["servicio"]["tmp_name"]["imagen"])->fit(800,600);
                $servicio->setImagen($nombreImagen);
            }

            $errores = $servicio->validar();

            if(empty($errores)) {
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);
                
                $servicio->guardar();
            }
        }

        $router->render("servicios/crear", [
            "servicio" =>$servicio,
            "roles"=>$roles,
            "errores"=>$errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar("/admin");
        $servicio = Servicio::find($id);
        $errores = Servicio::getErrores();
        $roles = Rol::all();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            //Asignar los atributos 
            $args = $_POST["servicio"];
            $servicio->sincronizar($args);

            //Validacion
            $errores = $servicio->validar();

            //Subida de archivos
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            if($_FILES["servicio"]["tmp_name"]["imagen"]) {
                $image = Image::make($_FILES["servicio"]["tmp_name"]["imagen"])->fit(800,600);
                $servicio->setImagen($nombreImagen);
            }
    
            //Revisar que el array de errores este vacio
            if (empty($errores)) {
                // Almacenar la imagen
                if($_FILES["servicio"]["tmp_name"]["imagen"]) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                $servicio->guardar();
            }

        }

        $router->render("servicios/actualizar", [
            "servicio" => $servicio,
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
                    $servicio = Servicio::find($id);
                    $servicio->eliminar();
                }
            }
        }
    }

}