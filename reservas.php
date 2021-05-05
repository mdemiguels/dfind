<?php

require 'includes/config/database.php';

$db = conectarDB(); // Conexión con la Base de datos

// Extracción de datos de la tabla propiedad
$query = "SELECT p.*, i.imagen FROM propiedad p 
          JOIN imagen i ON p.idpropiedad = i.propiedad_idpropiedad 
          WHERE i.destacada = '1'";

$resultado_select = mysqli_query($db, $query);

$registrado = $_GET["registrado"] ?? null;

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Mis reservas</h1>

    <?php if (intval($registrado) === 1) : ?>
        <p class="alerta exito">Alojamiento registrado con éxito</p>
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
                        <a href="actualizar.php"><img class="icono-tabla" src="build/img/update.svg" alt="Icono actualizar" loading="lazy"></a>
                        <a href="#"><img class="icono-tabla" src="build/img/papelera.svg" alt="Icono papelera" loading="lazy"></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</main>

<?php
incluirTemplate('footer');
?>