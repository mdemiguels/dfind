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
        WHERE r.usuario_idusuario = 2 AND i.destacada = 1 AND r.fecha_inicio>now()
        ORDER BY r.fecha_inicio DESC;";

$resultado_select = mysqli_query($db, $query);

$registrado = $_GET["registrado"] ?? null;
$actualizado = $_GET["actualizado"] ?? null;
$eliminado = $_GET["eliminado"] ?? null;
$comentado = $_GET["comentado"] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    if ($id) {
        // Eliminar propiedad
        $delete_propiedad = "DELETE FROM reserva WHERE idreserva=$id;";
        $resultado_delete = mysqli_query($db, $delete_propiedad);

        if ($resultado_delete) {
            header("Location: reservas.php?eliminado=1");
        }
    }
}

incluirTemplate('header');

?>

<main class="contenedor seccion viewheight">
    <h1>Reservas actuales</h1>

    <?php if (intval($registrado) === 1) : ?>
        <p class="alerta exito">Reserva registrada con éxito</p>
    <?php endif; ?>

    <?php if (intval($eliminado) === 1) : ?>
        <p class="alerta exito">Reserva eliminada con éxito</p>
    <?php endif; ?>

    <a class="boton boton-verde" href="reservas_old.php">Historial de reservas</a>

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
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?php echo $reserva["idreserva"] ?>">
                                    <input class="icono-tabla" type="image" src="build/img/papelera.svg" alt="Icono papelera" loading="lazy">
                                </form>
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