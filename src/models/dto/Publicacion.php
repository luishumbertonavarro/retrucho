<?php
namespace App\models\dto;

use App\models\bll\ComunidadBLL;
use App\models\bll\UsuarioBLL;

class Publicacion
{

    private $id;
    private $titulo;
    private $descripcion;
    private $cantidadVotos;
    private $idComunidad;
    private $idUsuarioCreador;

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
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getCantidadVotos()
    {
        return $this->cantidadVotos;
    }

    /**
     * @param mixed $cantidadVotos
     */
    public function setCantidadVotos($cantidadVotos)
    {
        $this->cantidadVotos = $cantidadVotos;
    }

    /**
     * @return mixed
     */
    public function getIdComunidad()
    {
        return $this->idComunidad;
    }

    /**
     * @param mixed $idComunidad
     */
    public function setIdComunidad($idComunidad)
    {
        $this->idComunidad = $idComunidad;
    }

    /**
     * @return mixed
     */
    public function getIdUsuarioCreador()
    {
        return $this->idUsuarioCreador;
    }

    /**
     * @param mixed $idUsuarioCreador
     */
    public function setIdUsuarioCreador($idUsuarioCreador)
    {
        $this->idUsuarioCreador = $idUsuarioCreador;
    }
    public function getPersonaForDisplay(){
        $usuarioBLL=new UsuarioBLL();
        $objUsuario= $usuarioBLL->selectById($this->getIdUsuarioCreador());
        if($objUsuario==null){
            return "no definido";
        }
        return $objUsuario->getCorreo();
    }
    public function getComunidadForDisplay(){
        $comunidadBLL=new ComunidadBLL();
        $objComunidad= $comunidadBLL->selectById($this->getIdComunidad());
        if($objComunidad==null){
            return "no definido";
        }
        return $objComunidad->getNombre();
    }

}