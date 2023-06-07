<?php
    
    define("TEMPLATES_URL", __DIR__ . "/templates");
    define("FUNCIONES_URL", __DIR__ . "funciones.php");
    define("CARPETA_IMAGENES",$_SERVER["DOCUMENT_ROOT"] . "/imagenes/");

    function incluirTemplate(string $nombre, bool $inicio = false) {
        include TEMPLATES_URL."/${nombre}.php";
    }

    function estaAutenticado() : bool {
        session_start();
        if(!$_SESSION["login"]) {
            header("Location: /");
        }
        return false;
    }

    function debuguear($variable) {
        echo "<pre>";
        var_dump($variable);
        echo "</pre>";
        exit;
    }

    //Escapa / Sanitizar del HTML
    function s($html) : string {
        $s = htmlspecialchars($html);
        return $s;
    }
     
    //Validar tipo contenido
    function validarTipoContenido($tipo) {
        $tipos = ["usuario", "servicio", "canino"];

        return in_array($tipo, $tipos);
    }

    //Muestra los mensajes
    function mostrarNotificacion($codigo) {
        $mensaje = "";

        switch($codigo) {
            case 1:
                $mensaje = "Creado correctamente";
                break;
            case 2:
                $mensaje = " Actualizado Correctamente";
                break;
            case 3:
                $mensaje = "Eliminado Correctamente";
                break;
            case 4:
                $mensaje = "Registrado Correctamente";
                break;
            default:
                $mensaje = false;
                break;
        }
        return $mensaje;
    }

    function validarORedireccionar(string $url) {
         //Validar la URL por ID válido
        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header("Location: ${url}");
        }
        return $id;
    }

    function leerMas(String $texto, int $cantidad) : string
    {
        if(strlen($texto) >= $cantidad) {
            return "<span title='$texto'>" . substr($texto, 0, $cantidad) . " ...</span>";
        } else {
            return $texto;
        }
    }

    // Funcion que revisa que el usuario este autenticado
    function isAuth() : void {
        if(!isset($_SESSION["login"])) {
            header("Location: /");
        }
    }