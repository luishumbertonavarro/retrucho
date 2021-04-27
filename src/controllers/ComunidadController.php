<?php


namespace App\controllers;


use App\models\bll\ComunidadBLL;
use App\models\bll\UsuarioBLL;

class ComunidadController
{
    static function index()
    {
        $comunidadBLL = new ComunidadBLL();
        $listaComunidad = $comunidadBLL->selectAll();
        include_once 'src/views/comunidad/list.php';
    }

    public static function insert($request)
    {
        if (!isset($_SESSION["usuarioLoggeado"])) {
            ComunidadController::index();
            return;
        }
        $comunidadBLL = null;
        $id = 0;
        $comunidadBLL = new ComunidadBLL();
        $listaComunidad = $comunidadBLL->selectAll();
        $objComunidad=null;

        include_once "src/views/comunidad/form.php";
    }

    public static function create($request)
    {
        $comunidadBLL = new ComunidadBLL();
        if (isset($_REQUEST["titulo"])) {
            $nombre = $_REQUEST["titulo"];
            $userId=$_SESSION["idUser"];
            $comunidadBLL->insert($nombre,$userId);
        }
        ComunidadController::index();
    }

    public static function update($request)
    {
        $id = 0;
        $comunidadBLL = new ComunidadBLL();
        $objComunidad = null;
        if (isset($request["id"])) {
            $id = $request["id"];
            $objComunidad = $comunidadBLL->selectById($id);
        }
        $listaComunidad = $comunidadBLL->selectAll();

        include_once "src/views/comunidad/form.php";
    }

    public static function saveUpdate($request)
    {
        $comunidadBLL = new ComunidadBLL();
        if (isset($_REQUEST["titulo"]) && isset($_REQUEST["id"])) {
            $titulo = $_REQUEST["titulo"];
            $userId=$_SESSION["idUser"];
            $id=$_REQUEST["id"];
            $comunidadBLL->update($titulo,$userId, $id);
        }
        ComunidadController::index();
    }

    public static function delete($request)
    {
        $comunidadBLL = new ComunidadBLL();
        if (isset($request["id"])) {
            $id = $request["id"];
            $comunidadBLL->delete($id);
        }
        ComunidadController::index();
    }

    public static function borrarSesion()
    {
        unset($_SESSION["usuarioLoggeado"]);
        ComunidadController::index();
    }

}