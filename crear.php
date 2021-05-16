<?php

require 'includes/funciones.php';

$auth = isAuth();

if (!$auth) {
    header("Location: /dfind/");
}

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
    $coordenadas = mysqli_real_escape_string($db, $_POST["coords"]);


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

    if (strlen($descripcion) < 200 && strlen($descripcion) > 220) {
        $errores[] = "Debes añadir una descripción detallada de la vivienda de entre 150 y 320 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "El numero de habitaciones es obligatorio";
    }

    if (!$wc) {
        $errores[] = "El numero de baños es obligatorio";
    }

    if (!$coordenadas) {
        $errores[] = "La ubicación del alojamiento es obligatoria";
    }

    if (empty($errores)) {

        $lat = substr($coordenadas, 1, (strpos($coordenadas, ",")-1));
        $long = substr($coordenadas, (strpos($coordenadas, ",") + 2), -1);

        $insert_propiedad = "INSERT INTO propiedad(usuario_idusuario, titulo, precio, descripcion, habitaciones, wc, estacionamiento, latitud, longitud)
        VALUES(" . $_SESSION["id"] . ", '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$aparcamiento', '$lat', '$long');";
        $resultado_insert = mysqli_query($db, $insert_propiedad);

        echo "<pre>";
        var_dump($insert_propiedad);
        echo "</pre>";

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
            $flag = false;
            for ($i = 0; $i < count($imagenes); $i++) {
                $ruta_destino = md5(uniqid(rand(), true)) . ".jpg";
                if ($imagenes[$i]["name"]) {
                    move_uploaded_file($imagenes[$i]["tmp_name"], $dir_imagenes . $ruta_destino);

                    $destacada = 0;
                    if (!$flag) {
                        $destacada = 1;
                        $flag = true;
                    }

                    $insert_imagenes = "INSERT INTO imagen(propiedad_idpropiedad, imagen, destacada) 
                    VALUES($idpropiedad, '$ruta_destino', $destacada);";

                    $resultado_insert = mysqli_query($db, $insert_imagenes);
                }
            }
            header('Location: alquileres.php?registrado=1');
        }
    }
}

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
            <legend>Ubicación (Arrastre el marcador a su alojamiento)</legend>
            </div>
            <input type="text" name="coords" id="coords" readonly>
            </div>
            <div id="map2">
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCassddZiBKdhOXC5f7CbJITS8naXOvdXM"> </script>
            </div>

        </fieldset>

        <input type="submit" value="Crear" class="boton-verde">

    </form>
</main>

<?php
incluirTemplate('footer');
?>

<script type="text/javascript">
    var map;

    function initialize() {
        map = new google.maps.Map(document.getElementById('map2'), {
            zoom: 10,
            center: {
                lat: 36.7215799939073,
                lng: -4.424398787614669
            }
        });

        var marker = new google.maps.Marker({
            position: map.getCenter(),
            map: map,
            draggable: true
        });

        google.maps.event.addListener(marker, 'dragend', function(event) {
            document.getElementById("coords").value = this.getPosition().toString();
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>