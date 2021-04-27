<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Retrucho</title>
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet"/>
    <script type="text/javascript" src="vendor/components/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
</head>
<body>
<nav class="navbar navbar-dark bg-primary navbar-expand-lg ">
    <a class="navbar-brand" href="index.php?controller=comunidad">Redit trucho</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ver comunidades
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?controller=comunidad&action=list">Lista de Comunidades</a>
                    <?php if (isset($_SESSION["usuarioLoggeado"])): ?>
                    <a class="dropdown-item" href="index.php?controller=comunidad&action=insert">Crear comunidades</a>
                    <?php endif; ?>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Publicacion
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?controller=publicacion&action=list">Lista de publicaciones</a>

                </div>
            </li>
        </ul>
    </div>
    <span class="navbar-text">
        <?php if (!isset($_SESSION["usuarioLoggeado"])): ?>
                <a class="nav-link" href="index.php?controller=login&action=iniciarsesion">Login</a>
        <?php endif; ?>
        <?php if (isset($_SESSION["usuarioLoggeado"])): ?>
        <a class="nav-link" href="index.php?controller=comunidad&action=borrar-sesion">Cerrar sesion</a>
        <?php endif; ?>
    </span>
    <span class="navbar-text">
        <?php if (!isset($_SESSION["usuarioLoggeado"])): ?>
            <a class="nav-link" href="index.php?controller=login&action=registrarse">Registrarse</a>

        <?php endif; ?>

    </span>

</nav>
<?php
include_once "vendor/autoload.php";
?>