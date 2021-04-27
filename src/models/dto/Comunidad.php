<?php
namespace App\models\dto;

use App\models\bll\ComunidadBLL;
use App\models\bll\UsuarioBLL;

class Comunidad{
    private $id;
    private $nombre;
    private $usuarioId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * @param mixed $usuarioId
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

    public function getPersonaForDisplay(){
        $usuarioBLL=new UsuarioBLL();
        $objUsuario= $usuarioBLL->selectById($this->getUsuarioId());
        if($objUsuario==null){
            return "no definido";
        }
        return $objUsuario->getCorreo();
    }


}