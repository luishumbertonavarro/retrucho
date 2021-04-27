<?php


namespace App\controllers;
use App\models\bll\UsuarioBLL;
use App\models\bll\ComunidadBLL;

class UsuarioController
{

    static function index()
    {
        $comunidadBLL = new ComunidadBLL();
        $listaComunidad = $comunidadBLL->selectAll();
        include_once 'src/views/comunidad/list.php';
    }
    public static function insert()
    {
        $objUsuario = null;
        $id = 0;
        include_once "src/views/usuario/form.php";
    }

    public static function create($request)
    {
        $usuarioBLL = new UsuarioBLL();
        if (isset($request["email"]) && isset($request["password"])) {
            $correo = $request["email"];
            $contrasenha = $request["password"];

            $idInsertado = $usuarioBLL->insert($correo,$contrasenha);
            $_SESSION["ultimaPersonaInsertada"] = $idInsertado;
        }
        UsuarioController::index();
    }

    public static function update($request)
    {
        $id = 0;
        $personaBLL = new PersonaBLL();
        $objPersona = null;
        if (isset($request["id"])) {
            $id = $request["id"];
            $objPersona = $personaBLL->selectById($id);
//            $_SESSION["personaListaParaActualizar"] = $objPersona;
        }
        include_once "src/views/personas/form.php";
    }



    public static function delete($request)
    {
        $usuarioBLL = new UsuarioBLL();
        if (isset($request["id"])) {
            $id = $request["id"];
            $usuarioBLL->delete($id);
        }
//        unset($_SESSION["personaListaParaActualizar"]);
        UsuarioController::index();
    }

    public static function borrarSesion()
    {
        unset($_SESSION["usuarioLoggeado"]);
        UsuarioController::index();
    }


}