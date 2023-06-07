<?php

namespace Controllers;

use Model\Servicio;
use Model\Registro;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {
        $servicios = Servicio::get(3);
        $inicio = true;
        $router->render("paginas/index", [
            "servicios"=>$servicios,
            "inicio"=>$inicio
        ]);
    }

    public static function servicios(Router $router) {
        $servicios = Servicio::all();

        $router->render("paginas/servicios", [
            "servicios"=>$servicios
        ]);
    }

    public static function servicio(Router $router) {
        $id = validarORedireccionar("/servicios"); 
        //Buscar servicio por su id
        $servicio = Servicio::find($id);
        $router->render("paginas/servicio", [
            "servicio"=>$servicio
        ]);
    }

    public static function nosotros(Router $router) {
        $router->render("paginas/nosotros");
    }

    public static function contacto(Router $router) {
        $mensaje = null;

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            //Crear una nueva instancia de PHPMailer
            $respuestas = $_POST["contacto"];
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = "smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Username = "512a6649c62086";
            $mail->Password = "8464083e8eab32";
            $mail->SMTPSecure = "tls";
            $mail->Port = "2525";

            //Configurar el contenido del email
            $mail->setFrom("admin@FurryPetCamp.com");
            $mail->addAddress("admin@FurryPetCamp.com", "FurryPetCamp.com");
            $mail->Subject = "Tienes un nuevo mensaje";

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";

            //Definir el contenido
            $contenido = "<html>";
            $contenido .= "<p>Tienes un nuevo mensaje</p>";
            $contenido .= "<p>Nombre: " . $respuestas["nombre"] . "</p>";

            //Enviar de forma condicional algunos campos de email o telefono
            if($respuestas["contacto"] === "telefono") {
                $contenido .= "<p>Eligió ser contactodo por telefono:</p>";
                $contenido .= "<p>Telefono: " . $respuestas["telefono"] . "</p>";
                $contenido .= "<p>Fecha para contactar: " . $respuestas["fecha"] . "</p>";
                $contenido .= "<p>Hora: " . $respuestas["hora"] . "</p>";
            }else {
                //Es email, entoces agergamos el campo de email
                $contenido .= "<p>Eligió ser contactodo por email:</p>";
                $contenido .= "<p>E-mail: " . $respuestas["email"] . "</p>";
            }

            $contenido .= "<p>Mensaje: " . $respuestas["mensaje"] . "</p>";
            $contenido .= "<p>Prefiere ser contactado por: " . $respuestas["contacto"] . "</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;
            $mail->AltBody = "Esto es un texto alternativo sin HTML";

            //Enviar el email
            if($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            }else {
                $mensaje = "El mensaje no se pudo enviar";
            }
        }

        $router->render("paginas/contacto", [
            "mensaje"=>$mensaje
        ]);
    }

    public static function registro(Router $router) {

        $resultado = $_GET["resultado"] ?? null;

        $registro = new Registro;
        $errores = Registro::getErrores();

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $registro = new Registro($_POST["registro"]);

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if($_FILES["registro"]["tmp_name"]["imagen"]) {
                $image = Image::make($_FILES["registro"]["tmp_name"]["imagen"])->fit(800,600);
                $registro->setImagen($nombreImagen);
            }

            //debuguear($registro);
            $registro->hashpassword();
            
            $errores = $registro->validar();

            if(empty($errores)) {
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);
                
                $registro->guardarRegistro();
            }
        }

        $router->render("paginas/registro", [
            "registro"=>$registro,
            "errores"=>$errores,
            "resultado"=>$resultado
        ]);

    }

}