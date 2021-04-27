<?php

use App\models\dto\Comunidad;
use App\models\dto\Usuario;

include_once "src/views/components/header.php" ?>
<?php
/**
 * @var int $id
 * @var Usuario[] $listaUsuario
 * @var Comunidad[] $listaComunidad
 */
?>
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        Comunidades
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre de la comunidad</th>
                            <th>Creador</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ((array)$listaComunidad as $objComunidad): ?>
                            <tr>
                                <td><?php echo ($objComunidad == null) ? '' : $objComunidad->getNombre(); ?></td>
                                <td><?php echo ($objComunidad == null) ? '' : $objComunidad->getPersonaForDisplay(); ?></td>

                                <?php if (isset($_SESSION["usuarioLoggeado"]) && $objComunidad != null): ?>
                                    <td><a class="btn btn-success"
                                           href="index.php?controller=publicacion&action=insert&idComunidad=<?php echo ($objComunidad == null) ? '' : $objComunidad->getId() ?>">Crear
                                            Publicacion</a>
                                    </td>
                                <?php endif; ?>

                                <?php if (isset($_SESSION["usuarioLoggeado"]) && $objComunidad != null): ?>
                                    <td><a class="btn btn-success"
                                           href="index.php?controller=publicacion&action=listconId&idComunidad=<?php echo ($objComunidad == null) ? '' : $objComunidad->getId() ?>">Ver
                                            publicaciones</a>
                                    </td>
                                    <?php if (isset($_SESSION["usuarioLoggeado"]) && $objComunidad != null && $objComunidad->getPersonaForDisplay() == $_SESSION["usuarioLoggeado"]): ?>

                                        <td><a class="btn btn-primary"
                                               href="index.php?controller=comunidad&action=update&id=<?php echo ($objComunidad == null) ? '' : $objComunidad->getId(); ?>">Editar</a>
                                        </td>

                                        <td><a class="btn btn-danger"
                                               onclick="return confirm('¿Está seguro que desea eliminar a la comunidad?')"
                                               href="index.php?controller=comunidad&action=delete&id=<?php echo ($objComunidad == null) ? '' : $objComunidad->getId(); ?>">Eliminar</a>
                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include_once "src/views/components/footer.php" ?>