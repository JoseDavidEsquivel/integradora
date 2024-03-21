<?php

include('authentication.php');
include('includes/header.php');

?>

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">
            <?php include('message.php') ?>
            <div class="card">
                <div class="card-header">
                    <h4> Agregar Dispositivo
                        <a href="dispositivos.php" class="btn btn-danger float-end">Regresar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Obra Asociada</label>
                                <input type="text" name="obra_asociada" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Estado</label> </br>
                                <input type="checkbox" name="estado" class="form-check-input">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Texto en Pantalla</label>
                                <input type="text" name="texto_pantalla" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="device_add" class="btn btn-primary">Agregar Dispositivo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

    include('includes/footer.php');
    include('includes/scripts.php');

?>
