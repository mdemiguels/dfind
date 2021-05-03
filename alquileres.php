<?php

require 'includes/config/database.php';

$db = conectarDB(); // Conexión con la Base de datos

// Extracción de datos de la tabla propiedad
$query = "SELECT * FROM propiedad WHERE usuario_idusuario='" . $_SESSION["id"] . "';";

$registrado = $_GET["registrado"] ?? null;

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Mis alquileres</h1>

    <?php if (intval($registrado) === 1) : ?>
        <p class="alerta exito">Alojamiento registrado con éxito</p>
    <?php endif; ?>

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
            <tr>
                <td>Casita en la playa</td>
                <td><img class="imagen-tabla" src="img_propiedades/baed21c31c0a89d3ceb08477a2f278e4.jpg" alt="Imagen alojamiento"></td>
                <td>150</td>
                <td>
                    <a href="#"><img class="icono-tabla" src="build/img/papelera.svg" alt="Icono papelera" loading="lazy"></a>
                    <a href="#"><img class="icono-tabla" src="build/img/update.svg" alt="Icono actualizar" loading="lazy"></a>
                </td>
            </tr>
        </tbody>
    </table>

</main>

<?php
incluirTemplate('footer');
?>