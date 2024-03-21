<?php

include('authentication.php');
include('includes/header.php');

// URL de la API FastAPI
$url = 'http://localhost:8000/dispositivos';

// Configuración de la solicitud HTTP
$options = array(
    CURLOPT_RETURNTRANSFER => true,   // Devuelve el resultado como cadena en lugar de imprimirlo directamente
);

// Inicializar curl y configurar la URL y las opciones
$curl = curl_init($url);
curl_setopt_array($curl, $options);

// Ejecutar la solicitud HTTP y obtener la respuesta
$response = curl_exec($curl);

// Verificar si hubo errores en la solicitud HTTP
if (curl_errno($curl)) {
    echo 'Error al hacer la solicitud HTTP: ' . curl_error($curl);
} else {
    // Decodificar la respuesta JSON en un array asociativo
    $dispositivos = json_decode($response, true);

    // Verificar si la respuesta contiene dispositivos
    if ($dispositivos) {
        ?>

        <div class="container-fluid px-4">
            <div class="row mt-4">
                <div class="col-md-12">

                    <?php include('message.php') ?>

                    <div class="card">
                        <div class="card-header">
                            <h4> Ver Dispositivos
                                <a href="dispositivo-add.php" class="btn btn-primary float-end">Agregar nuevo dispositivo</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <th>Id</th>
                                        <th>Obra Asociada</th>
                                        <th>Estado</th>
                                        <th>Texto en Pantalla</th>
                                        <th>Fecha de creación</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dispositivos as $dispositivo) : ?>
                                            <tr>
                                                <td><?= $dispositivo['_id']; ?></td>
                                                <td><?= $dispositivo['obra_asociada']; ?></td>
                                                <td><?= $dispositivo['estado'] ? 'Visible' : 'Invisible'; ?></td>
                                                <td><?= implode(', ', $dispositivo['texto_pantalla']); ?></td>
                                                <td><?= date('Y-m-d H:i:s', strtotime($dispositivo['creado'])); ?></td>
                                                <!-- Agrega aquí las celdas de editar y eliminar según tus necesidades -->
                                                <td>
                                                    <a href="dispositivo-edit.php?id=<?= $dispositivo['_id']; ?>" class="btn btn-success">Editar</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="POST">
                                                        <input type="hidden" name="id" value="<?= $dispositivo['_id']; ?>">
                                                        <button type="submit" name="device_delete" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    } else {
        // Mostrar un mensaje si no se encontraron dispositivos
        echo '<div class="container-fluid px-4"><div class="row mt-4"><div class="col-md-12"><div class="alert alert-warning" role="alert">No se encontraron dispositivos.</div></div></div></div>';
    }
}

// Cerrar la conexión curl
curl_close($curl);

include('includes/footer.php');
include('includes/scripts.php');

?>
