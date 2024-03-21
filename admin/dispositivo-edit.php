<?php

include('authentication.php');
include('includes/header.php');

// Verificar si se proporcionó un ID de dispositivo
if(isset($_GET['id'])) {
    // Obtener el ID del dispositivo desde la URL
    $device_id = $_GET['id'];

    // URL de la API FastAPI para buscar detalles del dispositivo por ID
    $url = 'http://localhost:8000/buscar_dispositivo/' . $device_id;

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
        $device_details = json_decode($response, true);
        $device_details = json_decode($response, true)[0]; // Obtener el primer elemento del array

        $obra_asociada = $device_details['obra_asociada'];
        $texto_pantalla = $device_details['texto_pantalla'][0]; // Acceder al primer elemento del array de texto_pantalla
        $estado = $device_details['estado'];


        // Verificar si se obtuvieron los detalles del dispositivo correctamente
        if ($device_details) {
            // Resto del código para mostrar el formulario de edición y los campos de entrada
            ?>
            <div class="container-fluid px-4">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <?php include('message.php') ?>
                        <div class="card">
                            <div class="card-header">
                                <h4> Editar Dispositivo
                                    <a href="dispositivo-view.php" class="btn btn-danger float-end">Regresar</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="">Obra Asociada</label>
                                            <input type="text" name="obra_asociada" class="form-control" value="<?php echo $obra_asociada; ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Estado</label> </br>
                                            <input type="checkbox" name="estado" class="form-check-input" <?php echo $estado ? 'checked' : ''; ?>>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="">Texto en Pantalla</label>
                                            <input type="text" name="texto_pantalla" class="form-control" value="<?php echo $texto_pantalla; ?>" required>
                                        </div>
                                        <!-- Agrega un campo oculto para enviar el ID del dispositivo a editar -->
                                        <input type="hidden" name="id" value="<?php echo $device_id; ?>">
                                        <div class="col-md-12 mb-3">
                                            <button type="submit" name="device_update" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            // Mostrar un mensaje si no se encontraron detalles del dispositivo
            echo '<div class="alert alert-warning" role="alert">No se encontraron detalles del dispositivo.</div>';
        }
    }

    // Cerrar la conexión curl
    curl_close($curl);
} else {
    // Mostrar un mensaje si no se proporcionó un ID de dispositivo
    echo '<div class="alert alert-warning" role="alert">No se proporcionó un ID de dispositivo.</div>';
}

include('includes/footer.php');
include('includes/scripts.php');

?>
