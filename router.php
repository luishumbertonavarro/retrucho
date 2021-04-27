<?php

use App\controllers\LoginController;
use App\controllers\ComunidadController;
use App\controllers\PublicacionController;
use App\controllers\UsuarioController;

// cambiar la variable controller para cambiar la pantalla inicial----mirar ejemplo de la clase

$controller = "comunidad";
if (isset($_REQUEST["controller"])) {
    $controller = $_REQUEST["controller"];
}
$action = "list";
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
}

switch ($controller) {
    case "comunidad":
        switch ($action) {
            case "list":
                ComunidadController::index();
                break;
            case "insert":
                ComunidadController::insert($_REQUEST);
                break;
            case "create":
                ComunidadController::create($_REQUEST);
                break;
            case "update":
                ComunidadController::update($_REQUEST);
                break;
            case "saveupdate":
                ComunidadController::saveUpdate($_REQUEST);
                break;
            case "delete":
                ComunidadController::delete($_REQUEST);
                break;
            case "borrar-sesion":
                ComunidadController::borrarSesion();
                break;
        }
        break;
    case "publicacion":
        switch ($action) {
            case "list":
                PublicacionController::index();
                break;
            case "listconId":
                PublicacionController::verPublicaciondeComunidad($_REQUEST);
                break;
            case "positivo":
                PublicacionController::positivo($_REQUEST);
                break;
            case "negativo":
                PublicacionController::negativo($_REQUEST);
                break;
            case "insert":
                PublicacionController::insert($_REQUEST);
                break;
            case "create":
                PublicacionController::create($_REQUEST);
                break;
            case "update":
                PublicacionController::update($_REQUEST);
                break;
            case "saveupdate":
                PublicacionController::saveUpdate($_REQUEST);
                break;
            case "delete":
                PublicacionController::delete($_REQUEST);
                break;
            case "posteo":
                PublicacionController::ver($_REQUEST);
        }
        break;
    case "login":
        switch ($action) {
            case "iniciarsesion":
                LoginController::mostrarForm();
                break;
            case "postIniciarSesion":
                LoginController::iniciarSesion($_REQUEST);
                break;
            case "registrarse":
                LoginController::mostrarFormRegist();
                break;
            case "formRegistro":
                LoginController::registrarse($_REQUEST);
                break;
        }
        break;
}