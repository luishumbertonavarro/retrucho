<?php


namespace App\models\bll;


use App\models\dal\Connection;
use App\models\dto\Comunidad;
use App\models\dto\Usuario;
use PDO;

class UsuarioBLL
{
    function verificar($correo, $contrasenha){
        $objConecction = new Connection();
        $res = $objConecction->queryWithParams(
            "CALL sp_Usuarios_login2(:varCorreo, :varContrasenha)",
            array(
                ":varCorreo" => $correo,
                ":varContrasenha" => $contrasenha
            )
        );
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row["cantUsuarios"];
    }
    function selectByEmail($email)
    {
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams(
            "CALL 	sp_Usuario_getByEmail(:varEmail)",
            array(
                ":varEmail" => $email
            )
        );
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objUsuario = $this->rowToDto($row);
        return $objUsuario->getId();;
    }

    function insert($correo, $contrasenha)
    {

        $objConecction = new Connection();
        $res = $objConecction->queryWithParams(
                "CALL sp_Usuarios_insert(:varCorreo, :varContrasenha)",
            array(
                ":varCorreo" => $correo,
                ":varContrasenha" => $contrasenha
            )
        );
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row["lastInsertId"];
    }

    //FALTA UPDATE

    function delete($id)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams(
            "CALL sp_Usuarios_delete(:varId)",
            array(
                ":varId" => $id
            )
        );
    }

    function selectAll()
    {
        $listaUsuarios = array();
        $objConnection = new Connection();
        $res = $objConnection->query("CALL sp_Usuarios_selectAll()");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $usuarios = $this->rowToDto($row);
            $listaUsuarios[] = $usuarios;
        }
        return $listaUsuarios;
    }

    function selectById($id)
    {
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams(
            "CALL sp_Usuarios_selectById(:varId)",
            array(
                ":varId" => $id
            )
        );
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objUsuario = $this->rowToDto($row);
        return $objUsuario;
    }

    private function rowToDto($row)
    {
        $objUsuario = new Usuario();

        $objUsuario->setId($row["id"]);
        $objUsuario->setCorreo($row["correo"]);
        $objUsuario->setContrasenha($row["contrasenha"]);

        return $objUsuario;

    }
}