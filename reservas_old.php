<?php

require 'includes/funciones.php';

$auth = isAuth();

if (!$auth) {
    header("Location: /dfind/");
}

require 'includes/config/database.php';

$db = conectarDB(); // Conexión con la Base de datos

// Extracción de datos de la tabla propiedad
$query = "SELECT p.*, r.*, i.* FROM propiedad p
        JOIN imagen i ON i.propiedad_idpropiedad = p.idpropiedad 
        JOIN reserva r ON p.idpropiedad = r.propiedad_idpropiedad 
        WHERE r.usuario_idusuario = ". $_SESSION["id"] ." AND i.destacada = 1 AND r.fecha_inicio<now()
        ORDER BY r.fecha_inicio DESC";

$resultado_select = mysqli_query($db, $query);

$registrado = $_GET["registrado"] ?? null;
$actualizado = $_GET["actualizado"] ?? null;
$eliminado = $_GET["eliminado"] ?? null;
$comentado = $_GET["comentado"] ?? null;
$error = $_GET["error"] ?? null;

incluirTemplate('header');

?>

<main class="contenedor seccion viewheight">
    <h1>Reservas pasadas</h1>

    <?php if (intval($registrado) === 1) : ?>
        <p class="alerta exito">Reserva registrada con éxito</p>
    <?php endif; ?>

    <?php if (intval($comentado) === 1) : ?>
        <p class="alerta exito">Comentario creado con éxito</p>
    <?php endif; ?>

    <?php if (intval($error) === 1) : ?>
        <p class="alerta error">Ya ha comentado esa reserva</p>
    <?php endif; ?>

    <a class="boton boton-verde" href="reservas.php">Reservas actuales</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Mostrar resultados en la tabla -->
            <?php
            if ($resultado_select->num_rows === 0) {
                echo "<td colspan=6>Actualmente no tiene ninguna reserva</td>";
            } else {
                while ($reserva = mysqli_fetch_assoc($resultado_select)) :
                    $query = "SELECT * FROM valoracion WHERE reserva_idreserva = " . $reserva["idreserva"];
                    $resultado = mysqli_query($db, $query);

            ?>
                    <tr>
                        <td><?php echo $reserva["titulo"] ?></td>
                        <td><img class="imagen-tabla" src="img_propiedades/<?php echo $reserva["imagen"] ?>" alt="Imagen alojamiento"></td>
                        <td><?php echo $reserva["precio_total"] ?> €</td>
                        <?php
                        $fecha_inicio = date_format(date_create($reserva["fecha_inicio"]), "d-m-Y");
                        $fecha_fin = date_format(date_create($reserva["fecha_fin"]), "d-m-Y");
                        ?>
                        <td><?php echo $fecha_inicio ?></td>
                        <td><?php echo $fecha_fin ?></td>
                        <td>
                            <div class="acciones">
                            <?php if ($resultado->num_rows === 0) { ?>
                                <a href="valoracion.php?id=<?php echo $reserva["idreserva"]; ?>"><img class="icono-tabla" src="build/img/opinion.svg" alt="Icono actualizar" loading="lazy"></a>
                            <?php } else { ?>
                                <a href="reservas_old.php?error=1"><img class="icono-tabla" src="build/img/opinion.svg" alt="Icono actualizar" loading="lazy"></a>
                            <?php } ?>
                            </div>
                        </td>
                    </tr>
            <?php endwhile;
            } ?>
        </tbody>
    </table>

</main>

<?php
incluirTemplate('footer');
?>