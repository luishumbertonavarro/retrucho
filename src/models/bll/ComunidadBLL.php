<?php

namespace App\models\bll;

use App\models\dal\Connection;

use App\models\dto\Comunidad;
use PDO;

class ComunidadBLL
{
    function insert($nombre, $usuarioId)
    {
        $objConecction = new Connection();
        $res = $objConecction->queryWithParams(
            "CALL sp_Comunidad_insert(:varNombre, :varUsuarioId)",
            array(
                ":varNombre" => $nombre,
                ":varUsuarioId" => $usuarioId
            )
        );
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row["lastInsertId"];
    }

    function update($nombre, $idUsuarioCreador, $id)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams(
            "CALL  sp_Comunidad_update(:varNombre,:varUsuarioId, :varId)",
            array(
                ":varNombre" => $nombre,
                ":varUsuarioId" => $idUsuarioCreador,
                ":varId" => $id
            )
        );
    }

    function delete($id)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams(
            "CALL sp_Comunidad_delete(:varId)",
            array(
                ":varId" => $id
            )
        );
    }

    function selectAll()
    {
        $listaComunidad = array();
        $objConnection = new Connection();
        $res = $objConnection->query("CALL sp_Comunidad_selectAll()");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $comunidad = $this->rowToDto($row);
            $listaComunidad[] = $comunidad;
        }
        return $listaComunidad;
    }

    function selectById($id)
    {
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams(
            "CALL sp_Comunidad_selectById(:varId)",
            array(
                ":varId" => $id
            )
        );
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objComunidad = $this->rowToDto($row);
        return $objComunidad;
    }

    private function rowToDto($row)
    {
        $objComunidad = new Comunidad();

        $objComunidad->setId($row["id"]);
        $objComunidad->setNombre($row["nombre"]);
        $objComunidad->setUsuarioId($row["idUsuarioCreador"]);

        return $objComunidad;
    }
}