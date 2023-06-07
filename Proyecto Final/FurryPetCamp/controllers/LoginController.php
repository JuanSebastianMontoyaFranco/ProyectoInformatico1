<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function login(Router $router) {
        $errores = [];

        $auth = new Usuario;

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $auth = new Usuario($_POST);

            $errores = $auth->validarLogin();
            

            if(empty($errores)) {
                $usuario = Usuario::where("email", $auth->email);
                if($usuario) {
                    if($usuario->comprobarPassword($auth->password)) {
                        if(!isset($_SESSION)) {
                            session_start();
                        }
                    
                        $_SESSION["id"] = $usuario->id;
                        $_SESSION["nombre"] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION["email"] = $usuario->email;
                        $_SESSION["login"] = true;
                    
                        //redireccionamiento
                        if($usuario->rol_id === "1") {
                            header("Location: /admin");
                        } elseif ($usuario->rol_id === "6") {
                            header("Location: /cliente");
                        }  elseif ($usuario->rol_id === "2") {
                            header("Location: /instructor");
                        } elseif ($usuario->rol_id === "3") {
                            header("Location: /veterinario");
                        } elseif ($usuario->rol_id === "4") {
                            header("Location: /hotelero");
                        } elseif ($usuario->rol_id === "5") {
                            header("Location: /peluquero");
                        }
                    }
                } else {
                    Usuario::setErrores("error", "Usuario no encontrado");
                }
            }
        }
        $errores = Usuario::getErrores();

        $router->render("auth/login", [
            "errores"=>$errores
        ]);
        
        /*$errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {

            $auth = new Usuario($_POST);

            $errores = $auth

        }*/
    }

    public static function logout() {
        session_start();
        
        $_SESSION = [];

        header("Location: /");
    }
}