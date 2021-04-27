<?php

namespace App\models\bll;

use App\models\dal\Connection;

use App\models\dto\Publicacion;
use PDO;

class PublicacionBLL
{
    function insert($titulo, $descripcion, $cantidadVotos, $idComunidad, $idUsuarioCreador)
    {
        $objConecction = new Connection();
        $res = $objConecction->queryWithParams(
            "CALL sp_Publicacion_insert(:varTitulo, :varDescripcion, :varCantidadVotos, :varIdComunidad, :varIdUsuarioCreador)",
            array(
                ":varTitulo" => $titulo,
                "varDescripcion" => $descripcion,
                ":varCantidadVotos" => $cantidadVotos,
                ":varIdComunidad" => $idComunidad,
                ":varIdUsuarioCreador" => $idUsuarioCreador
            )
        );
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row["lastInsertId"];
    }
    //ELIMINAR ESTE METODO EJEMPLO
    function sumaPuntos($publicacionId,$email){
        $objConecction = new Connection();
        $objConecction->queryWithParams(
            "CALL  sp_Publicacion_sumarPuntos(:varPublicacionId, :varEmail)",
            array(
                ":varPublicacionId" => $publicacionId,
                ":varEmail" => $email
            )
        );
    }
    function restarPuntos($publicacionId,$email){
    $objConecction = new Connection();
    $objConecction->queryWithParams(
        "CALL  sp_Publicacion_sumarPuntos(:varPublicacionId, :varEmail)",
        array(
            ":varPublicacionId" => $publicacionId,
            ":varEmail" => $email
        )
    );
}

    function update($titulo, $descripcion, $id)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams(
            "CALL  sp_Publicacion_update(:varTitulo, :varDescripcion, :varId)",
            array(
                ":varTitulo" => $titulo,
                ":varDescripcion" => $descripcion,
                ":varId" => $id
            )
        );
    }

    function delete($id)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams(
            "CALL sp_Publicacion_delete(:varId)",
            array(
                ":varId" => $id
            )
        );
    }

    function selectAll()
    {
        $listaPublicacion = array();
        $objConnection = new Connection();
        $res = $objConnection->query("CALL sp_Publicacion_selectAll()");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $publicacion = $this->rowToDto($row);
            $listaPublicacion[] = $publicacion;
        }
        return $listaPublicacion;
    }

    function selectById($id)
    {
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams(
            "CALL sp_Publicacion_selectById(:varId)",
            array(
                ":varId" => $id
            )
        );
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objPublicacion = $this->rowToDto($row);
        return $objPublicacion;
    }

    function selectByComunidadId($id)
    {
        $listaPublicacion=array();
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams(
            "CALL sp_Publicacion_selectByComunidadId(:varId)",
            array(
                ":varId" => $id
            )
        );

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $publicacion = $this->rowToDto($row);
            $listaPublicacion[] = $publicacion;
        }
        return $listaPublicacion;
    }

    function selectByUserId($UserId)
    {
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams(
            "CALL sp_Publicacion_selectByUserId(:varUserId)",
            array(
                ":varId" => $UserId
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
        $objPublicacion = new Publicacion();

        $objPublicacion->setId($row["id"]);
        $objPublicacion->setTitulo($row["titulo"]);
        $objPublicacion->setDescripcion($row["descripcion"]);
        $objPublicacion->setCantidadVotos($row["cantidadVotos"]);
        $objPublicacion->setIdComunidad($row["idComunidad"]);
        $objPublicacion->setIdUsuarioCreador($row["idUsuarioCreador"]);

        return $objPublicacion;
    }
}