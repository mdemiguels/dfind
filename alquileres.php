<?php

session_start();
$auth =$_SESSION["login"];
if (!$auth) {
    header("Location: /dfind/");
}

require 'includes/config/database.php';

$db = conectarDB(); // Conexión con la Base de datos

// Extracción de datos de la tabla propiedad
$query = "SELECT p.*, i.imagen FROM propiedad p 
          JOIN imagen i ON p.idpropiedad = i.propiedad_idpropiedad 
          WHERE i.destacada = '1'";

$resultado_select = mysqli_query($db, $query);

$registrado = $_GET["registrado"] ?? null;
$actualizado = $_GET["actualizado"] ?? null;
$eliminado = $_GET["eliminado"] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) {
        // Eliminar imagenes
        $select = "SELECT imagen FROM imagen WHERE propiedad_idpropiedad=$id;";
        $resultado_select = mysqli_query($db, $select);

        while($imagen = mysqli_fetch_assoc($resultado_select)) {
            unlink("img_propiedades/".$imagen["imagen"]);
        }

        $delete_imagenes = "DELETE FROM imagen WHERE propiedad_idpropiedad=$id";
        $resultado_delete = mysqli_query($db, $delete_imagenes);

        // Eliminar propiedad
        $delete_propiedad = "DELETE FROM propiedad WHERE idpropiedad=$id;";
        $resultado_delete = mysqli_query($db, $delete_propiedad);

        if ($resultado_delete) {
            header("Location: alquileres.php?eliminado=1");
        }
    }
}

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Mis alquileres</h1>

    <?php if (intval($registrado) === 1) : ?>
        <p class="alerta exito">Alojamiento registrado con éxito</p>
    <?php endif; ?>

    <?php if (intval($actualizado) === 1) : ?>
        <p class="alerta exito">Alojamiento actualizado con éxito</p>
    <?php endif; ?>

    <?php if (intval($eliminado) === 1) : ?>
        <p class="alerta exito">Alojamiento eliminado con éxito</p>
    <?php endif; ?>

    <a class="boton boton-verde" href="crear.php">Nueva propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Mostrar resultados en la tabla -->
            <?php while ($propiedad = mysqli_fetch_assoc($resultado_select)) : ?>
                <tr>
                    <td><?php echo $propiedad["titulo"] ?></td>
                    <td><img class="imagen-tabla" src="img_propiedades/<?php echo $propiedad["imagen"] ?>" alt="Imagen alojamiento"></td>
                    <td><?php echo $propiedad["precio"] ?> €</td>
                    <td>
                        <a href="actualizar.php?id=<?php echo $propiedad["idpropiedad"]; ?>"><img class="icono-tabla" src="build/img/update.svg" alt="Icono actualizar" loading="lazy"></a>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad["idpropiedad"] ?>">
                            <input class="icono-tabla" type="image" src="build/img/papelera.svg" alt="Icono papelera" loading="lazy">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</main>

<?php
incluirTemplate('footer');
?>