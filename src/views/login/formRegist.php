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
                        Registrarse
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php?controller=comunidad" onsubmit="return validation();">
                            <input type="hidden" name="action"
                                   value="formRegistro"/>
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
                                    <input type="password" name="password" id="password" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label>Por favor ponga su contraseña de nuevo:</label>
                                </div>
                                <div>
                                    <input type="password" name="password2" id="password2" class="form-control"/>
                                    <em id="cp"></em>
                                </div>
                            </div>
                            <div>
                                <input type="submit" value="Registrarse" class="btn btn-success"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function validation(){
        if($("#password").val()!=$("#password2").val()){
            $("#password2").addClass('is-invalid');
            $("#cp").html('<span class="text-danger">Las contraseñas no son iguales!</span>');
            return false;
        }
    }
</script>
<?php include_once "src/views/components/footer.php" ?>