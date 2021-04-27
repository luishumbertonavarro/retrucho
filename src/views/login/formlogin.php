<?php


include_once "src/views/components/header.php" ?>
<?php
/**
 */
?>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card mt-3">
                    <div class="card-header">
                        Iniciar sesión
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php?controller=comunidad">
                            <?php if ($error != null): ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
                            <input type="hidden" name="action"
                                   value="postIniciarSesion"/>
                            <input type="hidden" name="controller" value="login"/>
                            <div class="form-group">
                                <div>
                                    <label>Correo:</label>
                                </div>
                                <div>
                                    <input type="email" name="email" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label>Contraseña:</label>
                                </div>
                                <div>
                                    <input type="password" name="password" class="form-control"/>
                                </div>
                            </div>
                            <div>
                                <input type="submit" value="Iniciar sesión" class="btn btn-primary"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once "src/views/components/footer.php" ?>