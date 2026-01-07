<?php
// CREATE
if (!empty($_POST['btnRegistrar'])) {
    $categoria = $_POST['txtcategoria'];
    $nombre    = $_POST['txtnombre'];
    $precio    = $_POST['txtprecio'];
    $foto      = ""; // valor por defecto

    // Validar si se subió una imagen
    if (!empty($_FILES["imagen"]["name"])) {
        $imagenTmp    = $_FILES["imagen"]["tmp_name"];
        $nombreImagen = $_FILES["imagen"]["name"];
        $tipoImagen   = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));

        // Validar formato permitido
        if ($tipoImagen == 'jpg' || $tipoImagen == 'jpeg' || $tipoImagen == 'png') {
            $carpetaDestino = "uploads/";
            $nombreFinal    = uniqid("prod_") . "." . $tipoImagen; // solo nombre
            $rutaFinal      = $carpetaDestino . $nombreFinal;

            // Mover nueva foto
            if (move_uploaded_file($imagenTmp, $rutaFinal)) {
                $foto = $nombreFinal; // guardar SOLO el nombre en BD
            }
        } else {
            echo "<div class='alert alert-danger'>Formato no permitido (solo JPG, JPEG, PNG)</div>";
        }
    }

    // Validar campos obligatorios
    if (!empty($categoria) && !empty($nombre) && !empty($precio)) {    
        // Insertar producto con foto (si existe)
        $registrar = $conexion->query("INSERT INTO productos (categoria_id, nombre, precio, foto) 
                                       VALUES ($categoria, '$nombre', '$precio', '$foto')");
        if ($registrar) {
            echo "<div class='alert alert-success'>Producto Registrado</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al registrar producto</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Debe llenar todos los campos</div>";
    }
}

//UPDATE
if (!empty($_POST['btnModificar'])) {
    $categoria = $_POST['txtcategoria'];
    $nombre    = $_POST['txtnombre'];
    $precio    = $_POST['txtprecio'];
    $id        = $_POST['txtid'];
    $foto      = $_POST['foto_actual']; // nombre actual de la foto (hidden en el form)

    if (!empty($categoria) && !empty($nombre) && !empty($precio)) {    

        // Validar si se subió una nueva imagen
        if (!empty($_FILES["imagen"]["name"])) {
            $imagenTmp    = $_FILES["imagen"]["tmp_name"];
            $nombreImagen = $_FILES["imagen"]["name"];
            $tipoImagen   = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));

            if ($tipoImagen == 'jpg' || $tipoImagen == 'jpeg' || $tipoImagen == 'png') {
                $carpetaDestino = "uploads/";
                $nombreFinal    = uniqid("prod_") . "." . $tipoImagen; // solo nombre
                $rutaFinal      = $carpetaDestino . $nombreFinal;

                // Eliminar foto anterior si existe
                if (!empty($foto) && file_exists($carpetaDestino . $foto)) {
                    unlink($carpetaDestino . $foto);
                }

                // Mover nueva foto
                if (move_uploaded_file($imagenTmp, $rutaFinal)) {
                    $foto = $nombreFinal; // guardar SOLO el nombre en BD
                }
            } else {
                echo "<div class='alert alert-danger'>Formato no permitido (solo JPG, JPEG, PNG)</div>";
            }
        }

        // Actualizar producto con foto (si existe)
        $actualizar = $conexion->query("UPDATE productos 
                                        SET categoria_id=$categoria, nombre='$nombre', precio='$precio', foto='$foto' 
                                        WHERE id=$id");

        if ($actualizar) {
            echo "<div class='alert alert-success'>Producto Actualizado</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar producto</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Debe llenar todos los campos</div>";
    }
}
//DELETE
if(!empty($_GET['id'])){
    $id    = $_GET['id'];

    // Obtener el nombre de la foto antes de eliminar
    $resultado = $conexion->query("SELECT foto FROM productos WHERE id=$id");
    if($resultado && $resultado->num_rows > 0){
        $fila = $resultado->fetch_assoc();
        $archivo = $fila['foto'];
    }

    $eliminar = $conexion->query("DELETE FROM productos WHERE id=$id");
     
    if ($eliminar) {
        // Eliminar archivo físico si existe
        if(!empty($archivo) && file_exists("uploads/".$archivo)){
            unlink("uploads/".$archivo);
        }
        echo "<div class='alert alert-danger'>Producto y foto eliminados</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar producto</div>";
    }
} 

//ELIMINA PARÁMETROS de la URL, sin recargar la página
?>
<script>
    window.history.replaceState(null,null,location.pathname);
</script>
