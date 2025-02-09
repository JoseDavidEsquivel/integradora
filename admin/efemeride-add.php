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
                    <h4> Agregar Efemeride
                        <a href="post-view.php" class="btn btn-danger float-end">Regresar</a>
                    </h4>
                    
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="">Nombre</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                                
                            <div class="col-md-6 mb-3">
                                <label for="">Fecha de la Efemeride</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Estado</label> </br>
                                <!-- <input type="checkbox" name="status" width="70px" height="70px" /> -->
                                <input type="checkbox" name="status" class="form-check-input">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Descripción</label>
                                <textarea name="description" id="summernote" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" name="efemeride_add"class="btn btn-primary">Guardar Efemeride</button>
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
