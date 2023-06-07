<?php
require_once __DIR__ . "/../includes/app.php";

use Controllers\APIController;
use Controllers\ClienteController;
use Controllers\LoginController;
use MVC\Router;
use Controllers\PaginasController;
use Controllers\ServicioController;
use Controllers\UsuarioController;

$router = new Router();

//Zona Privada
$router->get("/admin", [ServicioController::class, "index"]);
$router->get("/servicios/crear", [ServicioController::class, "crear"]);
$router->post("/servicios/crear", [ServicioController::class, "crear"]);
$router->get("/servicios/actualizar", [ServicioController::class, "actualizar"]);
$router->post("/servicios/actualizar", [ServicioController::class, "actualizar"]);
$router->post("/servicios/eliminar", [ServicioController::class, "eliminar"]);


$router->get("/usuarios/admin", [UsuarioController::class, "index"]);
$router->get("/usuarios/crear", [UsuarioController::class, "crear"]);
$router->post("/usuarios/crear", [UsuarioController::class, "crear"]);
$router->get("/usuarios/actualizar", [UsuarioController::class, "actualizar"]);
$router->post("/usuarios/actualizar", [UsuarioController::class, "actualizar"]);
$router->post("/usuarios/eliminar", [UsuarioController::class, "eliminar"]);

$router->get("/usuarios/citas", [UsuarioController::class, "citasAdmin"]);


//Zona Publica
$router->get("/", [PaginasController::class, "index"]);
$router->get("/servicios", [PaginasController::class, "servicios"]);
$router->get("/servicio", [PaginasController::class, "servicio"]);
$router->get("/nosotros", [PaginasController::class, "nosotros"]);
$router->get("/contacto", [PaginasController::class, "contacto"]);
$router->post("/contacto", [PaginasController::class, "contacto"]);
$router->get("/registro", [PaginasController::class, "registro"]);
$router->post("/registro", [PaginasController::class, "registro"]);


//Login y autenticacion
$router->get("/login", [LoginController::class, "login"]);
$router->post("/login", [LoginController::class, "login"]);
$router->get("/logout", [LoginController::class, "logout"]);


//Cliente 
$router->get("/cliente", [UsuarioController::class, "cliente"]);
$router->get("/cliente/canino", [UsuarioController::class, "canino"]);
$router->post("/cliente/canino", [UsuarioController::class, "canino"]);
$router->get("/caninos/actualizar", [UsuarioController::class, "actualizarCanino"]);
$router->post("/caninos/actualizar", [UsuarioController::class, "actualizarCanino"]);
$router->post("/caninos/eliminar", [UsuarioController::class, "eliminarCanino"]);
$router->get("/cliente/citas", [UsuarioController::class, "citasCliente"]);

//Api de clientes
$router->get("/api/servicios", [APIController::class, "index"]);
$router->post("/api/citas", [APIController::class, "guardar"]);
$router->post("/api/eliminar", [APIController::class, "eliminar"]);

//Veterinario 
$router->get("/veterinario", [UsuarioController::class, "veterinario"]);
$router->post("/api/eliminarVeterinario", [APIController::class, "eliminarVeterinario"]);
//Peluquero
$router->get("/peluquero", [UsuarioController::class, "peluquero"]);
$router->post("/api/eliminarPeluquero", [APIController::class, "eliminarPeluquero"]);
//Hotelero
$router->get("/hotelero", [UsuarioController::class, "hotelero"]);
$router->post("/api/eliminarHotelero", [APIController::class, "eliminarHotelero"]);
//Instructor
$router->get("/instructor", [UsuarioController::class, "instructor"]);
$router->post("/api/eliminarInstructor", [APIController::class, "eliminarInstructor"]);

$router->comprobarRutas();