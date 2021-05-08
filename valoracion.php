<?php

require 'includes/funciones.php';

$auth = isAuth();

if (!$auth) {
    header("Location: /dfind/");
}

require 'includes/config/database.php';

$db = conectarDB(); // Conexión con la Base de datos

$errores = [];

$opinion = '';
$estrellas = 0;
$idreserva = $_GET["id"];

// Recepción de los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $errores = []; // Reinicio de la variable errores

    if (isset($_POST['estrellas'])) {
        $estrellas = mysqli_real_escape_string($db, $_POST["estrellas"]);
    }
    $opinion = mysqli_real_escape_string($db, $_POST["opinion"]);

    // Validación de formulario
    if (!$estrellas) {
        $errores[] = "Debes puntuar con estrellas la estancia";
    }
    if (strlen($opinion) < 100) {
        $errores[] = "La opinión debe contar con más de 100 caracteres";
    }


    if (empty($errores)) {

        $insert_propiedad = "INSERT INTO valoracion(usuario_idusuario, reserva_idreserva, valoracion, opinion)
        VALUES(" . $_SESSION["id"] . ", $idreserva, $estrellas, '$opinion');";
        $resultado_insert = mysqli_query($db, $insert_propiedad);

        if ($resultado_insert) {
            header('Location: reservas_old.php?comentado=1');
        }
    }
}

incluirTemplate('header');

?>

<main class="contenedor seccion">

    <?php
    foreach ($errores as $error) {
        echo "<div class='alerta error'>";
        echo $error;
        echo "</div>";
    }
    ?>
    <h1>Dejanos tu opinión</h1>
    <form class="formulario-valoracion" method="POST">

        <fieldset>
            <legend>¿Qué te ha parecido la estancia?</legend>
            <p class="clasificacion">
                <input id="radio1" type="radio" name="estrellas" value="5">
                <label for="radio1">★</label>
                <input id="radio2" type="radio" name="estrellas" value="4">
                <label for="radio2">★</label>
                <input id="radio3" type="radio" name="estrellas" value="3">
                <label for="radio3">★</label>
                <input id="radio4" type="radio" name="estrellas" value="2">
                <label for="radio4">★</label>
                <input id="radio5" type="radio" name="estrellas" value="1">
                <label for="radio5">★</label>
            </p>
            <p class="opinion">Opinión</p>
            <textarea name="opinion"><?php echo $opinion; ?></textarea>

        </fieldset>

        <input type="submit" value="Crear" class="boton-verde">

    </form>
</main>

<?php
incluirTemplate('footer');
?>