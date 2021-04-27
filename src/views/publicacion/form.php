<?php use App\models\dto\Publicacion;

include_once "src/views/components/header.php" ?>
<?php
/**
 * @var int $id
 * @var int $idComunidad
 * @var Publicacion $objPublicacion
 */
?>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card mt-3">
                    <div class="card-header">
                        Formulario de Publicaciones
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php">
                            <input type="hidden" name="id" value="<?php echo $id ?>"/>
                            <input type="hidden" name="controller" value="publicacion"/>
                            <input type="hidden" name="action"
                                   value="<?php echo ($id == 0) ? "create" : "saveupdate"; ?>"/>
                            <input type="hidden" name="idComunidad" value="<?php echo $idComunidad ?>"/>

                            <div class="form-group">
                                <div>
                                    <label>Titulo:</label>
                                </div>
                                <div>
                                    <input type="text" name="titulo" class="form-control"
                                           value="<?php echo ($objPublicacion == null) ? '' : $objPublicacion->getTitulo(); ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label>Descripcion:</label>
                                </div>
                                <div>
                                    <input type="text" name="descripcion" class="form-control"
                                           value="<?php echo ($objPublicacion == null) ? '' : $objPublicacion->getDescripcion(); ?>"/>
                                </div>
                            </div>
                            <div>
                                <input type="submit" value="Enviar datos" class="btn btn-primary"/>
                                <a href="index.php" class="btn btn-link">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once "src/views/components/footer.php" ?>