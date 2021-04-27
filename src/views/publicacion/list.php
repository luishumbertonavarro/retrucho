<?php
use App\models\dto\Publicacion;
include_once "src/views/components/header.php" ?>
<?php
/**
 * @var int $id
 * @var Publicacion[] $listaPublicacion
 */
?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        Publicaciones
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th><i class="bi bi-star"></i></th>
                            <th>Titulo</th>
                            <th>Comunidad</th>
                            <th>Creado por</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ((array)$listaPublicacion as $objPublicacion): ?>
                            <tr>
                                <td><?php echo ($objPublicacion == null) ? '' : $objPublicacion->getCantidadVotos(); ?></td>
                                <td><?php echo ($objPublicacion == null) ? '' : $objPublicacion->getTitulo(); ?></td>
                                <td><?php echo ($objPublicacion == null) ? '' :$objPublicacion->getComunidadForDisplay(); ?></td>
                                <td><?php echo ($objPublicacion == null) ? '' :$objPublicacion->getPersonaForDisplay(); ?></td>
                                <td><a class="btn btn-success"
                                       href="index.php?controller=publicacion&action=posteo&id=<?php echo $objPublicacion->getId(); ?>&comunidadId=<?php echo $objPublicacion->getIdComunidad();?>">Ver publicacion</a>
                                </td>
                            <?php if (isset($_SESSION["usuarioLoggeado"])&& $objPublicacion->getPersonaForDisplay()==$_SESSION["usuarioLoggeado"]): ?>
                                <td><a class="btn btn-primary" href="index.php?controller=publicacion&action=update&id=<?php echo $objPublicacion->getId(); ?>">Editar</a>
                                </td>

                                <td><a class="btn btn-danger"
                                       onclick="return confirm('¿Está seguro que desea eliminar la publicacion?')"
                                       href="index.php?controller=publicacion&action=delete&id=<?php echo $objPublicacion->getId(); ?>">Eliminar</a>
                                </td>
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