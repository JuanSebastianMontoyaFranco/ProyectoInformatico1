<?php
namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar() {

        // Almacena cita y devuelve el ID  
        $cita = new Cita($_POST);
        $resultado = $cita->guardarCita();

        $id = $resultado["id"];

        //Almacena la cita y el servicio
        $idServicios = explode(",", $_POST["servicios"]);

        foreach($idServicios as $idServicio) {
            $args = [
                "citaid" => $id,
                "servicioid" => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardarCita();
        }
        //Retornamos una respuesta 

        echo json_encode(["resultado" => $resultado]);
    }

    public static function eliminar() {
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $cita = Cita::find($_POST["id"]);
            $cita->eliminar();
        }
    }

    public static function eliminarVeterinario() {
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $cita = Cita::find($_POST["id"]);
            $cita->eliminarVeterinario();
        }
    }

    public static function eliminarPeluquero() {
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $cita = Cita::find($_POST["id"]);
            $cita->eliminarPeluquero();
        }
    }

    public static function eliminarHotelero() {
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $cita = Cita::find($_POST["id"]);
            $cita->eliminarHotelero();
        }
    }

    public static function eliminarInstructor() {
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $cita = Cita::find($_POST["id"]);
            $cita->eliminarInstructor();
        }
    }
}