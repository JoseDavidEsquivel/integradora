<?php

    include('authentication.php');

    if(isset($_POST['artwork-update'])){

        $artwork_id = $_POST['artwork_id'];

        $name = mysqli_real_escape_string($conn, $_POST['name']);

        $image = $_FILES['image']['tmp_name'];

        $status = mysqli_real_escape_string($conn, $_POST['status'] == true ? '1' : '0');

        if($image != NULL){

            $imgContenido = addslashes(file_get_contents($image));

            $query = "UPDATE artwork SET id='$artwork_id', name='$name', image='$imgContenido', status='$status' WHERE id='$artwork_id'";
            $query_run = mysqli_query($conn, $query);

            if($query_run){

                $_SESSION['message'] = "Se actulizó correctamente";
                header('Location: artwork-view.php');
                exit(0);
            } else {

                $_SESSION['message'] = "Ocurrió algún error";
                header('Location: artwork-view.php');
                exit(0);
            }
            
        } else {
 
            $query = "UPDATE artwork SET id='$artwork_id', name='$name', status='$status' WHERE id='$artwork_id'";
            $query_run = mysqli_query($conn, $query);

            if($query_run){

                $_SESSION['message'] = "Se actulizó correctamente";
                header('Location: artwork-view.php');
                exit(0);
            } else {

                $_SESSION['message'] = "Ocurrió algún error";
                header('Location: artwork-view.php');
                exit(0);
            }

        }

        
    }


    if(isset($_POST['artwork-add'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);

        $image = $_FILES['image']['tmp_name'];
        // $image = $_FILES['image']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));

        $status = mysqli_real_escape_string($conn, $_POST['status'] == true ? '1' : '0');

        $image_query = "INSERT INTO artwork (name, image, status) VALUES ('$name', '$imgContenido','$status')";
        $image_query_run = mysqli_query($conn, $image_query);

        if($image_query_run){

            $_SESSION['message'] = "Se subió una nueva imagen";
            header('Location: artwork-view.php');
            exit(0);
        } else {

            $_SESSION['message'] = "Ocurrió un error";
            header('Location: artwork-view.php');
            exit(0);
        }

    }


    if(isset($_POST['curiosity_update'])){

        $curiosity_id = $_POST['curiosity_id'];

        $name = mysqli_real_escape_string($conn, $_POST['name']);


        $description = mysqli_real_escape_string($conn, $_POST['description']);

        $status = $_POST['status'] == true ? '1':'0';

        $query = "UPDATE curiosity SET id='$curiosity_id', description='$description', status='$status' WHERE id='$curiosity_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){

            $_SESSION['message'] = "Se ha agregado con exito";
            header('Location: view-curiosity.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ha ocurrido algo";
            header('Location: view-curiosity.php');
            exit(0);
        }
    }


    if(isset($_POST['efemeride_delete_btn'])){

        $efemeride_id = $_POST['efemeride_delete_btn'];

        $query = "DELETE FROM efemeride WHERE id='$efemeride_id' LIMIT 1";
        $query_run = mysqli_query($conn, $query);

        if($query_run){

            $_SESSION['message'] = "Se ha agregado con exito";
            header('Location: view-efemeride.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ha ocurrido algo";
            header('Location: view-efemeride.php');
            exit(0);
        }


    }

    if(isset($_POST['efemeride_update'])){

        $efemeride_id = $_POST['efemeride_id'];

        $name = mysqli_real_escape_string($conn, $_POST['name']);

        $date = date('Y-m-d', strtotime($_POST['date']));

        $description = mysqli_real_escape_string($conn, $_POST['description']);

        $status = $_POST['status'] == true ? '1':'0';

        $query = "UPDATE efemeride SET id='$efemeride_id', name='$name', date='$date', description='$description', status='$status' WHERE id='$efemeride_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){

            $_SESSION['message'] = "Se ha agregado con exito";
            header('Location: efemeride-add.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ha ocurrido algo";
            header('Location: efemeride-add.php');
            exit(0);
        }
    }

    if(isset($_POST['efemeride_add'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);

        $date = date('Y-m-d', strtotime($_POST['date']));

        $description = mysqli_real_escape_string($conn, $_POST['description']);

        $status = mysqli_real_escape_string($conn, $_POST['status'] == true ? '1' : '0');

        $query = "INSERT INTO efemeride (name, date, description, status) VALUES ('$name', '$date', '$description', '$status')";
        $query_run = mysqli_query($conn, $query);

        if($query_run){

            $_SESSION['message'] = "Se ha agregado con exito";
            header('Location: efemeride-add.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ha ocurrido algo";
            header('Location: efemeride-add.php');
            exit(0);
        }

    }


    if(isset($_POST['post_delete_btn'])){
        
        $post_id = $_POST['post_delete_btn'];
/* 
        $check_img_query = "SELECT * FROM posts WHERE id = '$post_id' LIMIT 1";
        $img_res = mysqli_query($conn, $check_img_query);
        $res_data = mysqli_fetch_array($img_res);

        $image = $res_data['image']; */

        $query = "DELETE FROM posts WHERE id='$post_id' LIMIT 1";
        $query_run = mysqli_query($conn, $query);
    

        if($query_run){

/*             if(file_exists('../uploads/posts/'.$image)){
                unlink('../uploads/posts/'.$image);

        } */
            
            $_SESSION['message'] = "Se ha borrado con exito";
            header('Location: post-view.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Algo a salido mal";
            header('Location: post-view.php?');
            exit(0);

        }

    }

    if(isset($_POST['post_update'])){

        $post_id = $_POST['post_id'];
        $category_id = $_POST['category_id'];

        $name = mysqli_real_escape_string($conn, $_POST['name']);

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']); // Remover los caracteres especiales
        $final_string = preg_replace('/-+/', '-', $string);

        $slug = $final_string;


        $description = mysqli_real_escape_string($conn, $_POST['description']);


        $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
        $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
        $meta_keyword = mysqli_real_escape_string($conn, $_POST['meta_keyword']);
        
        
        $image = $_FILES['image']['tmp_name'];
        // $image = $_FILES['image']['tmp_name'];

        
        // $old_filename = mysqli_real_escape_string($conn, $_POST['old_image']);

        /*$image = $_FILES['image']['name'];

        $update_filename = ""; */

        // $newimg = "";
        

        $status =  $_POST['status'] == true ? '1':'0';

        if($image != NULL){
            
        $imgContenido = addslashes(file_get_contents($image));

            
        $query = "UPDATE posts SET category_id='$category_id',  name='$name', slug='$slug', description='$description', image='$imgContenido', meta_title='$meta_title', meta_description='$meta_description', meta_keyword='$meta_keyword',
                status='$status' WHERE id = '$post_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){

/*             if($image != NULL){
                if(file_exists('../uploads/posts/'.$old_filename)){
                    unlink('../uploads/posts/'.$old_filename);

                }
                move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/'.$update_filename);
            }
             */
            
            $_SESSION['message'] = "Se ha actualizado con exito";
            header('Location: post-add.php?id='.$post_id);
            exit(0);

        } else {

            $_SESSION['message'] = "Algo a salido mal";
            header('Location: post-add.php?id='.$post_id);
            exit(0);

        }


        } else {


        $query = "UPDATE posts SET category_id='$category_id',  name='$name', slug='$slug', description='$description', meta_title='$meta_title', meta_description='$meta_description', meta_keyword='$meta_keyword',
                status='$status' WHERE id = '$post_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){

/*             if($image != NULL){
                if(file_exists('../uploads/posts/'.$old_filename)){
                    unlink('../uploads/posts/'.$old_filename);

                }
                move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/'.$update_filename);
            }
             */
            
            $_SESSION['message'] = "Se ha actualizado con exito";
            header('Location: post-add.php?id='.$post_id);
            exit(0);

        } else {

            $_SESSION['message'] = "Algo a salido mal";
            header('Location: post-add.php?id='.$post_id);
            exit(0);

        }


        }
 

/*         $query = "UPDATE posts SET category_id='$category_id',  name='$name', slug='$slug', description='$description', image='$imgContenido', meta_title='$meta_title', meta_description='$meta_description', meta_keyword='$meta_keyword',
                status='$status' WHERE id = '$post_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){

            if($image != NULL){
                if(file_exists('../uploads/posts/'.$old_filename)){
                    unlink('../uploads/posts/'.$old_filename);

                }
                move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/'.$update_filename);
            }
             
            
            $_SESSION['message'] = "Se ha actualizado con exito";
            header('Location: post-add.php?id='.$post_id);
            exit(0);

        } else {

            $_SESSION['message'] = "Algo a salido mal";
            header('Location: post-add.php?id='.$post_id);
            exit(0);

        } */

    }


    if(isset($_POST['post_add'])){
        
        $category_id = $_POST['category_id'];

        $name = mysqli_real_escape_string($conn, $_POST['name']);

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']); // Remover los caracteres especiales
        $final_string = preg_replace('/-+/', '-', $string);

        $slug = $final_string;


        $description = mysqli_real_escape_string($conn, $_POST['description']);

        $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
        $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
        $meta_keyword = mysqli_real_escape_string($conn, $_POST['meta_keyword']);

        $image = $_FILES['image']['tmp_name'];
        // $image = $_FILES['image']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));

        //Renombramos la imagen
/*         $image_extension = pathinfo($image, PATHINFO_EXTENSION);

        $filename = time().'.'.$image_extension;
 */
        $status = mysqli_real_escape_string($conn, $_POST['status'] == true ? '1': '0');

        // Check if slug is unique
        $check_query = "SELECT * FROM posts WHERE slug = '$slug'";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $_SESSION['message'] = "El slug ya está en uso";
            header('Location: post-add.php');
            exit(0);
        }

        $query = "INSERT INTO posts (category_id,name,slug,description,image,meta_title,meta_description,meta_keyword,status) VALUES
                    ('$category_id','$name','$slug','$description','$imgContenido','$meta_title','$meta_description','$meta_keyword','$status')";

        $query_run = mysqli_query($conn, $query);

        if($query_run){

            //Movemos la imagen

            // move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/'.$filename); // Almacenamos la imagen
        
            $_SESSION['message'] = "Se ha agragado un nuevo post";
            header('Location: post-add.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Algo a salido mal";
            header('Location: post-add.php');
            exit(0);

        }

    }

    if(isset($_POST['category_delete'])){

        $category_id = $_POST['category_delete'];

        
        $query = "DELETE FROM categories WHERE id='$category_id'";
        // 2 = delete
        // $query = "UPDATE categories SET status= '1' WHERE id='$category_id' LIMIT 1";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
        
            $_SESSION['message'] = "Se ha borrado con exito";
            header('Location: category_view.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Algo a salido mal";
            header('Location: category_view.php');
            exit(0);

        }
    }

    // if(isset($_POST['category_suspend'])){

    //     $category_id = $_POST['category_suspend'];


    //     // 2 = delete
    //     $query = "UPDATE categories SET status= '1' WHERE id='$category_id' LIMIT 1";
    //     $query_run = mysqli_query($conn, $query);

    //     if($query_run){
        
    //         $_SESSION['message'] = "Se ha borrado con exito";
    //         header('Location: category_view.php');
    //         exit(0);

    //     } else {

    //         $_SESSION['message'] = "Algo a salido mal";
    //         header('Location: category_view.php');
    //         exit(0);

    //     }
    // }

    if(isset($_POST['category_update'])){

        $category_id = $_POST['category_id'];

        $name = mysqli_real_escape_string($conn, $_POST['name']);

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']); // Remover los caracteres especiales
        $final_string = preg_replace('/-+/', '-', $string);

        $slug = $final_string;

        $description = mysqli_real_escape_string($conn, $_POST['description']);

        $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
        $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
        $meta_keyword = mysqli_real_escape_string($conn, $_POST['meta_keyword']);

        $navbar_status = mysqli_real_escape_string($conn, $_POST['navbar_status'] == true ? '1': '0');
        $status = mysqli_real_escape_string($conn, $_POST['status'] == true ? '1': '0');

        // Check if slug is unique
        $check_query = "SELECT * FROM categories WHERE slug = '$slug'";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $_SESSION['message'] = "El slug ya está en uso";
            header('Location: category-add.php');
            exit(0);
        }

        $query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', meta_description='$meta_description', meta_keyword='$meta_keyword', navbar_status='$navbar_status', status='$status' WHERE id='$category_id'";

        $query_run = mysqli_query($conn, $query);

        if($query_run){

            $_SESSION['message'] = "Actualizado con éxito";
            header('Location: category-edit.php?id='.$category_id);
            exit(0);

        } else {

            $_SESSION['message'] = "Ocurrió algún error";
            header('Location: category-edit.php?id='.$category_id);
            exit(0);

        }

    }


    if(isset($_POST['category_add'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']); // Remover los caracteres especiales
        $final_string = preg_replace('/-+/', '-', $string);

        $slug = $final_string;
        
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
        $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
        $meta_keyword = mysqli_real_escape_string($conn, $_POST['meta_keyword']);

        $navbar_status = mysqli_real_escape_string($conn, $_POST['navbar_status'] == true ? '1': '0');
        $status = mysqli_real_escape_string($conn, $_POST['status'] == true ? '1': '0');

        // Check if slug is unique
        $check_query = "SELECT * FROM categories WHERE slug = '$slug'";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $_SESSION['message'] = "El slug ya está en uso";
            header('Location: category-add.php');
            exit(0);
        }

        $query = "INSERT INTO categories (name,slug,description,meta_title,meta_description,meta_keyword,navbar_status,status) VALUES
                    ('$name','$slug','$description','$meta_title','$meta_description','$meta_keyword','$navbar_status','$status')";
        $query_run = mysqli_query($conn, $query);

        if($query_run){

            $_SESSION['message'] = "Se ha agregado con exito";
            header('Location: category-add.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ocurrió algún error";
            header('Location: category-add.php');
            exit(0);

        }
    }

// CODIGO PARA EL MODULO DE DISPOSITIVOS
// CODIGO PARA EL MODULO DE DISPOSITIVOS
// CODIGO PARA EL MODULO DE DISPOSITIVOS
// CODIGO PARA EL MODULO DE DISPOSITIVOS
// CODIGO PARA EL MODULO DE DISPOSITIVOS

    if(isset($_POST['device_add'])){

        // Validar el estado

        $estado = $_POST['estado'] == true ? '1': '0';
        // URL de la API FastAPI
        $url = 'http://localhost:8000/agregar_dispositivo';

        // Datos del dispositivo a enviar
        $data = array(
            'obra_asociada' => $_POST['obra_asociada'],
            'texto_pantalla' => array($_POST['texto_pantalla']),
            'estado' => $estado
        );
    
        // Convertir datos a formato JSON
        $data_string = json_encode($data);
    
        // Configuración de la solicitud HTTP
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // Devuelve el resultado como cadena en lugar de imprimirlo directamente
            CURLOPT_POST => true,             // Método POST
            CURLOPT_POSTFIELDS => $data_string, // Datos del dispositivo como JSON
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json', // Tipo de contenido JSON
                'Content-Length: ' . strlen($data_string) // Longitud del cuerpo de la solicitud
            )
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
            // Decodificar la respuesta JSON
            $result = json_decode($response, true);
    
            // Verificar si la solicitud fue exitosa
            if($result === true) {
                // Redirigir al usuario a la página dispositivos-view.php
                header('Location: dispositivo-view.php');
                exit;
            } else {
                // Mostrar mensaje de error genérico
                echo 'Error al agregar el dispositivo';
                echo '<pre>';
                print_r($result);
                echo '</pre>';
                echo '<pre>';
                echo 'hola';
                
                echo '</pre>';
                print_r($estado);
            }
        }
    
        // Cerrar la conexión curl
        curl_close($curl);
    }
    
    if(isset($_POST['device_update'])){
        // Validar el estado del checkbox
        $estado = isset($_POST['estado']) && $_POST['estado'] === 'on' ? 1 : 0;
        
        // URL de la API FastAPI para editar dispositivo
        $id = $_POST['id'];
        $url = 'http://localhost:8000/actualizar_dispositivo/' . $id ;
    
        // Datos del dispositivo a enviar
        $data = array(
            'obra_asociada' => $_POST['obra_asociada'],
            'texto_pantalla' => array($_POST['texto_pantalla']),
            'estado' => $estado
        );
    
        // Convertir datos a formato JSON
        $data_string = json_encode($data);
    
        // Configuración de la solicitud HTTP
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // Devuelve el resultado como cadena en lugar de imprimirlo directamente
            CURLOPT_CUSTOMREQUEST => "PUT",   // Método PUT para editar el dispositivo
            CURLOPT_POSTFIELDS => $data_string, // Datos del dispositivo como JSON
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json', // Tipo de contenido JSON
                'Content-Length: ' . strlen($data_string) // Longitud del cuerpo de la solicitud
            )
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
            // Decodificar la respuesta JSON
            $result = json_decode($response, true);
    
            // Verificar si la solicitud fue exitosa
            if($result === true) {
                // Redirigir al usuario a la página dispositivos-view.php
                header('Location: dispositivo-view.php');
                exit;
            } else {
                // Mostrar mensaje de error genérico
                echo 'Error al editar el dispositivo';
            }
        }
    
        // Cerrar la conexión
        curl_close($curl);
    }
    
    if(isset($_POST['device_delete'])){
        // URL de la API FastAPI para eliminar dispositivo
        $id = $_POST['id'];
        $url = 'http://localhost:8000/eliminar_dispositivo/' . $id ;
        
        // Configuración de la solicitud HTTP
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // Devuelve el resultado como cadena en lugar de imprimirlo directamente
            CURLOPT_CUSTOMREQUEST => "DELETE"   // Método DELETE para eliminar el dispositivo
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
            // Decodificar la respuesta JSON
            $result = json_decode($response, true);
        
            // Verificar si la solicitud fue exitosa
            if($result === true) {
                // Redirigir al usuario a la página dispositivos-view.php
                $_SESSION['message'] = "Se ha borrado con exito";
                header('Location: dispositivo-view.php');
                exit;
            } else {
                // Mostrar mensaje de error genérico
                echo 'Error al eliminar el dispositivo';
            }
        }
        
        // Cerrar la conexión
        curl_close($curl);
    }
    
?>
