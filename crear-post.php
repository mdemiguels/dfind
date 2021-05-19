<?php
require 'includes/funciones.php';
session_start();

$admin = $_SESSION["admin"] ?? false;

if (!$admin) {
    header("Location: /dfind/");
}

require 'includes/config/database.php';

$db = conectarDB(); // Conexión con la Base de datos

$errores = [];

$titulo = '';
$contenido = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $errores = []; // Reinicio de la variable errores

    $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
    $imagen = $_FILES["imagen"];
    $contenido = mysqli_real_escape_string($db, $_POST["contenido"]);

    // Validación de formulario
    if (!$titulo) {
        $errores[] = "Debes añadir un título";
    }

    // Comprobación de que se haya subido al menos 1 imagen y que no pese más de 1.5MB
    $tamanio = 1000000 * 1.5;
    $flag_name = false;
    $flag_tamanio = false;

    if ($imagen["name"]) {
        $flag_name = true;
    }
    if ($imagen["size"] > $tamanio) {
        $flag_tamanio = true;
    }

    if (!$flag_name) {
        $errores[] = "Debe introducir una imagen";
    }

    if ($flag_tamanio) {
        $errores[] = "El tamaño de la imagen no debe ser mayor de 1.5MB";
    }

    if (strlen($contenido) < 200) {
        $errores[] = "El contenido del post debe ser mayor de 200 caracteres";
    }

    if (empty($errores)) {

        // Subida de imágenes al servidor:

        // Crear carpeta Imagenes
        $dir_imagenes = "img_blog/";
        if (!is_dir($dir_imagenes)) {
            mkdir($dir_imagenes);
        }

        // Generar un nombre único
        $flag = false;

        $ruta_destino = md5(uniqid(rand(), true)) . ".jpg";
        if ($imagen["name"]) {
            move_uploaded_file($imagen["tmp_name"], $dir_imagenes . $ruta_destino);

            $insert_imagen = "INSERT INTO blog(titulo, contenido, imagen) 
                    VALUES('$titulo', '$contenido', '$ruta_destino');";

            echo $insert_imagen;

            $resultado_insert = mysqli_query($db, $insert_imagen);
            if ($resultado_insert) {
                header('Location: blog.php?registrado=1');
            }
        }
    }
}

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Crear Post</h1>

    <?php
    foreach ($errores as $error) {
        echo "<div class='alerta error'>";
        echo $error;
        echo "</div>";
    }
    ?>


    <form class="formulario" action="crear-post.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Datos del post</legend>

            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" placeholder="Título del post">

            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" accept="image/jpeg, image/png">

            <label for="contenido">Contenido</label>
            <textarea id="contenido" name="contenido"><?php echo $contenido; ?></textarea>

        </fieldset>


        <input type="submit" value="Crear" class="boton-verde">

    </form>

</main>

<?php
incluirTemplate('footer');
?>