<?php

namespace App\models\dto;

use App\models\bll\UsuarioBLL;
class Usuario
{

    private $id;
    private $correo;
    private $contrasenha;

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
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getContrasenha()
    {
        return $this->contrasenha;
    }

    /**
     * @param mixed $contrasenha
     */
    public function setContrasenha($contrasenha)
    {
        $this->contrasenha = $contrasenha;
    }

}