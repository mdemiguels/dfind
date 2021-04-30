<?php

require 'includes/config/database.php';

$db = conectarDB();

$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$aparcamiento = '';
$wc = '';
$lat = '';
$long = '';

// Recepción de los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $errores = [];

    $titulo = $_POST["titulo"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $habitaciones = $_POST["habitaciones"];
    $aparcamiento = $_POST["aparcamiento"];
    $wc = $_POST["wc"];
    $lat = $_POST["latitud"];
    $long = $_POST["longitud"];

    //Validación de formulario
    if (!$titulo) {
        $errores[] = "Debes añadir un título";
    }
    if (!$precio) {
        $errores[] = "El campo de precio es obligatorio";
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
        $query = "INSERT INTO propiedad(titulo, precio, descripcion, habitaciones, wc, estacionamiento, latitud, longitud) 
                VALUES('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$latitud', '$longitud');";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo '<script type="text/javascript">alert("Datos insertados correctamente."); window.location.href="alquileres.php";</script>';
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

    <form class="formulario" action="" method="POST">
        <fieldset>
            <legend>Inforación alojamiento</legend>

            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" placeholder="Título propiedad">

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" value="<?php echo $precio; ?>" placeholder="Precio por día" min="0">

            <label>Imágenes</label>
            <div class="contenedor-imagenes">
                <input type="file" accept="image/jpeg, image/png">
                <input type="file" accept="image/jpeg, image/png">
                <input type="file" accept="image/jpeg, image/png">
                <input type="file" accept="image/jpeg, image/png">
                <input type="file" accept="image/jpeg, image/png">
                <input type="file" accept="image/jpeg, image/png">
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