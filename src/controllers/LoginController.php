<?php
namespace App\controllers;


use App\models\bll\ComunidadBLL;
use App\models\bll\UsuarioBLL;

class LoginController
{
    public static function mostrarForm($error = "")
    {
        include_once "src/views/login/formlogin.php";
    }
    public static function mostrarFormRegist()
    {
        include_once "src/views/login/formRegist.php";
    }

    public static function iniciarSesion($request)
    {
        $usuarioBLL=new UsuarioBLL();
        $usuario = $request["email"];
        $password = $request["password"];
        //AQUI ACOMODAR EL LOGIN
        ;
        if($usuarioBLL->verificar($usuario,$password)>0)
        {
            $_SESSION["usuarioLoggeado"] = $usuario;

            $_SESSION["idUser"]=$usuarioBLL->selectByEmail($usuario);
            UsuarioController::index();
            return;
        }
        $error = "Usuario o contraseña incorrectas";
        LoginController::mostrarForm($error);
    }

    public static function registrarse($request)
    {

        $usuarioBLL = new UsuarioBLL();
        if (isset($request["email"]) && isset($request["password"])) {
            $correo = $request["email"];
            $password = $request["password"];


            $usuarioBLL->insert($correo, $password);

        }
        LoginController::mostrarForm();
    }
}