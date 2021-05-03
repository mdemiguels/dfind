<?php

require 'includes/config/database.php';

$db = conectarDB(); // Conexión con la Base de datos

$errores = [];

$titulo = '';
$precio = '';
$imagenes = [];
$descripcion = '';
$habitaciones = '';
$aparcamiento = '';
$wc = '';
$lat = '';
$long = '';

// Recepción de los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $errores = []; // Reinicio de la variable errores

    $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
    $precio = mysqli_real_escape_string($db, $_POST["precio"]);
    $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
    $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
    $aparcamiento = mysqli_real_escape_string($db, $_POST["aparcamiento"]);
    $wc = mysqli_real_escape_string($db, $_POST["wc"]);
    $lat = mysqli_real_escape_string($db, $_POST["latitud"]);
    $long = mysqli_real_escape_string($db, $_POST["longitud"]);

    // Obtener imagenes del formulario
    for ($i = 1; $i <= count($_FILES); $i++) {
        $imagenes[] = $_FILES["imagen" . $i];
    }

    // Validación de formulario
    if (!$titulo) {
        $errores[] = "Debes añadir un título";
    }
    if (!$precio) {
        $errores[] = "El campo de precio es obligatorio";
    }

    // Comprobación de que se haya subido al menos 1 imagen y que no pese más de 1.5MB
    $tamanio = 1000000 * 1.5;
    $flag_name = false;
    $flag_tamanio = false;

    foreach ($imagenes as $imagen) {
        if ($imagen["name"]) {
            $flag_name = true;
        }
        if ($imagen["size"] > $tamanio) {
            $flag_tamanio = true;
        }
    }

    if (!$flag_name) {
        $errores[] = "Debe introducir al menos una imagen";
    }

    if ($flag_tamanio) {
        $errores[] = "El tamaño de las imagenes no debe ser mayor de 1.5MB";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "Debes añadir una descripción detallada de la vivienda de al menos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "El numero de habitaciones es obligatorio";
    }

    if (!$wc) {
        $errores[] = "El numero de baños es obligatorio";
    }

    if (!$lat || !$long) {
        $errores[] = "Los datos de ubicación son obligacorios";
    }



    if (empty($errores)) {

        $insert_propiedad = "INSERT INTO propiedad(titulo, precio, descripcion, habitaciones, wc, estacionamiento, latitud, longitud)
        VALUES('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$aparcamiento', '$lat', '$long');";
        $resultado_insert = mysqli_query($db, $insert_propiedad);

        if ($resultado_insert) {
            $select_id = "SELECT idpropiedad FROM propiedad WHERE latitud = '$lat' AND longitud = '$long'";
            $resultado_select = mysqli_query($db, $select_id);

            if ($idpropiedad = mysqli_fetch_assoc($resultado_select)) {
                $idpropiedad = $idpropiedad["idpropiedad"];
            }
            // Subida de imágenes al servidor

            // Crear carpeta Imagenes
            $dir_imagenes = "img_propiedades/";
            if (!is_dir($dir_imagenes)) {
                mkdir($dir_imagenes);
            }

            // Generar un nombre único
            foreach ($imagenes as $imagen) {
                $ruta_destino = md5(uniqid(rand(), true)) . ".jpg";
                if ($imagen["name"]) {
                    move_uploaded_file($imagen["tmp_name"], $dir_imagenes . $ruta_destino);

                    $insert_imagenes = "INSERT INTO imagen(propiedad_idpropiedad, imagen) 
                    VALUES('$idpropiedad', '$ruta_destino');";

                    $resultado_insert = mysqli_query($db, $insert_imagenes);
                }
            }
            header('Location: alquileres.php?mensaje=Propiedad creada con éxito');
        }
    }
}

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Crear alojamiento</h1>

    <?php
    foreach ($errores as $error) {
        echo "<div class='alerta error'>";
        echo $error;
        echo "</div>";
    }
    ?>

    <form class="formulario" action="crear.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Inforación alojamiento</legend>

            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" placeholder="Título propiedad">

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" value="<?php echo $precio; ?>" placeholder="Precio por día" min="0">

            <label>Imágenes</label>
            <div class="contenedor-imagenes">
                <input type="file" name="imagen1" accept="image/jpeg, image/png">
                <input type="file" name="imagen2" accept="image/jpeg, image/png">
                <input type="file" name="imagen3" accept="image/jpeg, image/png">
                <input type="file" name="imagen4" accept="image/jpeg, image/png">
                <input type="file" name="imagen5" accept="image/jpeg, image/png">
                <input type="file" name="imagen6" accept="image/jpeg, image/png">
            </div>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Características</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Número de habitaciones" min="1" max="10" value="<?php echo $habitaciones; ?>">

            <label for="aparcamiento">Aparcamiento</label>
            <input type="number" id="aparcamiento" name="aparcamiento" placeholder="Plazas de aparcamiento" min="0" max="5" value="<?php echo $aparcamiento; ?>">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" placeholder="Número de baños" min="1" max="5" value="<?php echo $wc; ?>">

        </fieldset>

        <fieldset>
            <legend>Ubicación</legend>
            <label for="latitud">latitud</label>
            <input type="text" id="latitud" name="latitud" value="<?php echo $lat; ?>" placeholder="Ej: 36.72639109069393">

            <label for="longitud">longitud</label>
            <input type="text" id="longitud" name="longitud" value="<?php echo $long; ?>" placeholder="Ej: -4.443076401628604">

        </fieldset>

        <input type="submit" value="Crear" class="boton-verde">

    </form>
</main>

<?php
incluirTemplate('footer');
?>