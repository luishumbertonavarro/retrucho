<?php

use App\models\dto\Publicacion;
use App\models\dto\Usuario;
use App\models\dto\Comunidad;

include_once "src/views/components/header.php" ?>
<?php
/**
 * @var int $id
 * @var int $userId
 * @var Publicacion $objPublicacion
 * @var Usuario $UsuarioCreador
 */
?>
<div class="container">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="card mt-3">
                <input type="hidden" name="publicacionId" value="<?php echo $id ?>"/>
                <?php print_r($id)?>
                <div class="card-header">
                    <?php if (isset($_SESSION["usuarioLoggeado"])): ?>

                    <a href="index.php?controller=publicacion&action=positivo&id=<?php echo $id ?>"><i class="bi bi-arrow-up-circle"></i></a>
                    <a href="index.php?controller=publicacion&action=negativo&id=<?php echo $id ?>"><i class="bi bi-arrow-down-circle" style="color:red"></i></a>
                    <?php endif;?>
                    <h5 class="card-title"><?php echo $objPublicacion->getTitulo() ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $objPublicacion->getDescripcion() ?></p>
                    <p class="card-text"><i class="bi bi-star"> <?php echo $objPublicacion->getCantidadVotos() ?> </i>
                    </p>
                    <?php //AGREGAR COMO HACER PUNTAJE?>
                </div>

                <div class="card-body">
                    <a href="index.php" class="card-link">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "src/views/components/footer.php" ?>
