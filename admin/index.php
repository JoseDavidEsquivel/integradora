<?php

    include('authentication.php');
    include('includes/header.php');

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Panel de Administración</h1>
    <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item active">Menú de Administración</li>
    </ol>
    <?php include('message.php'); ?>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    Total de Categorias
                    <?php

                        $dash_category_query = "SELECT * FROM categories";
                        $dash_category_query_run = mysqli_query($conn, $dash_category_query);

                        if($category_total = mysqli_num_rows($dash_category_query_run)){

                            echo '<h4 class="mb-0"> '.$category_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> Sin datos </h4>';

                        }

                    ?>

                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="category-view.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    Total de Post
                    <?php

                        $dash_post_query = "SELECT * FROM posts";
                        $dash_post_query_run = mysqli_query($conn, $dash_post_query);

                        if($post_total = mysqli_num_rows($dash_post_query_run)){

                            echo '<h4 class="mb-0"> '.$post_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> Sin datos </h4>';

                        }
                    
                    ?>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="post-view.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    Total de Usuarios
                    <?php

                        $dash_users_query = "SELECT * FROM users";
                        $dash_users_query_run = mysqli_query($conn, $dash_users_query);

                        if($users_total = mysqli_num_rows($dash_users_query_run)){

                            echo '<h4 class="mb-0"> '.$users_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> Sin datos </h4>';

                        }
                    


                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="view-register.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    Usuarios Bloqueados
                    <?php

                        $dash_block_query = "SELECT * FROM users WHERE status='1'";
                        $dash_block_query_run = mysqli_query($conn, $dash_block_query);

                        if($block_total = mysqli_num_rows($dash_block_query_run)){

                            echo '<h4 class="mb-0"> '.$block_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> 0 </h4>';

                        }
                    


                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="view-block.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

    include('includes/footer.php');
    include('includes/scripts.php');

?>
