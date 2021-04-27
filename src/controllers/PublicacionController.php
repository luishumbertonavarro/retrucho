<?php


namespace App\controllers;


use App\models\bll\ComunidadBLL;
use App\models\bll\PublicacionBLL;
use App\models\bll\UsuarioBLL;

class PublicacionController
{


    static function index()
    {
        $publicacionBLL = new PublicacionBLL();
        $listaPublicacion = $publicacionBLL->selectAll();
        include_once 'src/views/publicacion/list.php';
    }
    public static function insert($request)
    {
        if (!isset($_SESSION["usuarioLoggeado"])) {
            ComunidadController::index();
            return;
        }
        $idComunidad=$_REQUEST["idComunidad"];
        $comunidadBLL=new ComunidadBLL();
        $objComunidad=$comunidadBLL->selectAll();
        $objPublicacion = null;
        $id = 0;
        include_once "src/views/publicacion/form.php";
    }
    static function ver($request)
    {
        $publicacionBLL = new PublicacionBLL();
        $objPublicacion=null;
        if (isset($request["id"])) {
            $id = $request["id"];
            $objPublicacion = $publicacionBLL->selectById($id);
        }
        include_once 'src/views/publicacion/publicacion.php';
    }
    static function verPublicaciondeComunidad($request)
    {

        $publicacionBLL = new PublicacionBLL();
        $idComunidad=$_REQUEST["idComunidad"];
        $listaPublicacion = $publicacionBLL->selectByComunidadId($idComunidad);
        include_once 'src/views/publicacion/list.php';
    }

    public static function create($request)
    {

        $publicacionBLL = new PublicacionBLL();
        if (isset($_REQUEST["titulo"]) && isset($_REQUEST["descripcion"])&& isset($_REQUEST["idComunidad"])) {
            $titulo = $_REQUEST["titulo"];
            $descripcion=$_REQUEST["descripcion"];
            $idCreador = $_SESSION["idUser"];
            $idComunidad=$_REQUEST["idComunidad"];
            $publicacionBLL->insert($titulo, $descripcion,0,$idComunidad,$idCreador);
        }
        PublicacionController::index();
    }

    public static function update($request)
    {
        $id = 0;
        $publicacionBLL = new PublicacionBLL();
        $userBLL = new UsuarioBLL();
        $objPublicacion = null;
        if (isset($request["id"])) {
            $id = $request["id"];
            $objPublicacion = $publicacionBLL->selectById($id);
        }
        $listaPersonas = $publicacionBLL->selectAll();

        include_once "src/views/publicacion/form.php";
    }


    public static function saveUpdate($request)
    {
        $publicacionBLL = new PublicacionBLL();

        if (isset($request["titulo"])&& isset($request["descripcion"])&& isset($request["idComunidad"])) {
            $titulo = $request["titulo"];
            $descripcion=$request["descripcion"];
            $id = $request["id"];
            $publicacionBLL->update($titulo, $descripcion, $id);
        }
        PublicacionController::index();
    }

    public static function delete($request)
    {
        $publicacionBLL = new PublicacionBLL();
        if (isset($request["id"])) {
            $id = $request["id"];
            $publicacionBLL->delete($id);
        }
        PublicacionController::index();
    }

    public static function borrarSesion()
    {
        unset($_SESSION["usuarioLoggeado"]);
        ComunidadController::index();
    }

    public static function positivo($request)
    {
        if (!isset($_SESSION["usuarioLoggeado"])) {
            PublicacionController::index();
            return;
        }
        $publicacionBLL = new PublicacionBLL();
        if (isset($request["id"])) {
            $id = $request["id"];
            $email=$_SESSION["usuarioLoggeado"];
            $publicacionBLL->sumaPuntos($id,$email);
        }
        PublicacionController::index();

    }

    public static function negativo($request)
    {
        if (!isset($_SESSION["usuarioLoggeado"])) {
            PublicacionController::index();
            return;
        }
        $publicacionBLL = new PublicacionBLL();
        if (isset($request["id"])) {
            $id = $request["id"];
            $email=$_SESSION["usuarioLoggeado"];
            $publicacionBLL->restarPuntos($id,$email);
        }
        PublicacionController::index();
    }
}