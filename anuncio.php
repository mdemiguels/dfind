<?php

require 'includes/funciones.php';

$auth = isAuth();

require 'includes/config/database.php';

$errores = [];

$db = conectarDB();

$id = $_GET["id"];

$select_propiedad = "SELECT * FROM propiedad WHERE idpropiedad = $id;";
$result_propiedad = mysqli_query($db, $select_propiedad);
if (!$result_propiedad->num_rows) {
    header("Location: /dfind/");
}
$propiedad = mysqli_fetch_assoc($result_propiedad);

$select_imagenes = "SELECT * FROM imagen WHERE propiedad_idpropiedad = $id ORDER BY destacada DESC;";
$result_imagenes = mysqli_query($db, $select_imagenes);

$select_imagenes2 = "SELECT * FROM imagen WHERE propiedad_idpropiedad = $id ORDER BY destacada DESC;";
$result_imagenes2 = mysqli_query($db, $select_imagenes2);
$cont = 1;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($auth) {
        $errores = [];

        if (!$_POST["fecha_inicio"] || !$_POST["fecha_fin"]) {
            $errores[] = "Debe introducir una fecha";
        } else {
            $fecha_inicio = $_POST["fecha_inicio"];
            $fecha_inicio_compare = strtotime($fecha_inicio);
            $fecha_fin = $_POST["fecha_fin"];
            $fecha_fin_compare = strtotime($fecha_fin);

            if ($fecha_inicio > $fecha_fin) {
                $errores[] = "La fecha de fin debe ser mayor que la de inicio";
            } else {
                $select_reservas = "SELECT * FROM reserva WHERE propiedad_idpropiedad = $id";
                $result_reservas = mysqli_query($db, $select_reservas);

                $flag = false;
                while ($reserva = mysqli_fetch_assoc($result_reservas)) {
                    $rfecha_inicio = strtotime($reserva["fecha_inicio"]);
                    $rfecha_fin = strtotime($reserva["fecha_fin"]);

                    if (($fecha_inicio_compare >= $rfecha_inicio) && ($fecha_inicio_compare <= $rfecha_fin)) {
                        $errores[] = "La fecha de inicio introducida no está disponible";
                        $flag = true;
                    }
                    if (($fecha_fin_compare >= $rfecha_inicio) && ($fecha_fin_compare <= $rfecha_fin)) {
                        $errores[] = "La fecha de fin introducida no está disponible";
                        $flag = true;
                    }
                }
                if (empty($errores)) {
                    $date1 = new DateTime($fecha_inicio);
                    $date2 = new DateTime($fecha_fin);
                    $diff = $date1->diff($date2);
                    $dias = $diff->days;

                    $insert_reserva = "INSERT INTO reserva (propiedad_idpropiedad, usuario_idusuario, fecha_inicio, fecha_fin, precio_total)
                                   VALUES ($id," . $_SESSION['id'] . ", '$fecha_inicio', '$fecha_fin', " . $propiedad["precio"] * $dias . ");";
                    $result_insert = mysqli_query($db, $insert_reserva);

                    if ($result_insert) {
                        header("Location: reservas.php?registrado=1");
                    }
                }
            }
        }
    } else {
        echo '<script type="text/javascript">alert("Para reservar una propiedad debe iniciar sesión.");
              window.location.href="login.php";</script>';
    }
}

incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <?php
    foreach ($errores as $error) {
        echo "<div class='alerta error'>";
        echo $error;
        echo "</div>";
    }
    ?>
    <h1><?php echo $propiedad["titulo"]; ?></h1>


    <!-- Full-width images with number text -->
    <?php while ($imagen = mysqli_fetch_assoc($result_imagenes)) : ?>
        <div class="mySlides-gallery">
            <img src="img_propiedades/<?php echo $imagen["imagen"]; ?>" style="width:100%">
        </div>
    <?php
    endwhile;
    ?>

    <!-- Thumbnail images -->
    <div class="row">
        <?php while ($imagen = mysqli_fetch_assoc($result_imagenes2)) : ?>
            <div class="column">
                <img class="demo cursor" src="img_propiedades/<?php echo $imagen["imagen"]; ?>" style="width:100%" onclick="currentSlide(<?php echo $cont; ?>)">
            </div>
        <?php
            $cont++;
        endwhile;
        ?>
    </div>


    <div class="resumen-propiedad">
        <p class="precio">
            <?php echo $propiedad["precio"]; ?> € / por día
        </p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
                <p><?php echo $propiedad["wc"]; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" loading="lazy">
                <p><?php echo $propiedad["estacionamiento"]; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono habitaciones" loading="lazy">
                <p><?php echo $propiedad["habitaciones"]; ?></p>
            </li>
        </ul>

        <h2>Descripción</h2>
        <p>
            <?php echo $propiedad["descripcion"]; ?>
        </p>
    </div>

    <h2>Ubicación</h2>
    <div class="contenedor seccion" id="map">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCassddZiBKdhOXC5f7CbJITS8naXOvdXM"> </script>
    </div>

    <h2>Reserva</h2>
    <div class="contenedor seccion">
        <form class="formulario formulario-reserva" method="POST">
            <div class="reserva">
                <div>
                    <label for="date">Fecha inicio:</label>

                    <input type="date" name="fecha_inicio" min="<?php echo date("Y-m-d"); ?>">
                </div>

                <div>
                    <label for="date">Fecha fin:</label>
                    <input type="date" name="fecha_fin" min="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>
            <div class="contenedor-boton-reserva">
                <input class="boton-verde-block" type="submit" value="Reservar">
            </div>


        </form>
    </div>

    <?php
    $query = "SELECT v.*, u.nombre FROM valoracion v JOIN 
    reserva r ON v.reserva_idreserva = r.idreserva JOIN 
    usuario u ON v.usuario_idusuario = u.idusuario 
    WHERE r.propiedad_idpropiedad = $id ORDER BY valoracion DESC ";
    $resultado = mysqli_query($db, $query);

    ?>
    <h2>Comentarios</h2>
    <div class="contenedor seccion">
    <?php
    
    if ($resultado->num_rows > 0) {
        while ($comentario = mysqli_fetch_assoc($resultado)) : ?>
            <div class="comentario">
                <p>Usuario: <?php echo $comentario["nombre"] ? $comentario["nombre"] : 'Anónimo' ?> </p>
                <P>Estrellas: 
                <?php 
                for ($i=0; $i < $comentario["valoracion"]; $i++) { 
                    echo '<span class="iluminada">★</span>';
                }
                $diff = 5 - $comentario["valoracion"];
                for ($i=0; $i < $diff; $i++) { 
                    echo '★';
                }
    
                ?>
                </P>
                <P> Opinión: <br><?php echo $comentario["opinion"]; ?></P>
            </div>
        <?php endwhile; }else {
            echo "<div class='no-result'><p>Aún no hay comentarios de esta propiedad</p></div>";
        } ?>
    </div>

</main>


<?php
incluirTemplate('footer');
?>

<script>
    //galeria imagenes
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides-gallery");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
</script>


<script>
    var map_parameters = {
        center: {
            lat: <?php echo $propiedad["latitud"]; ?>,
            lng: <?php echo $propiedad["longitud"]; ?>
        },
        zoom: 17
    };
    var map = new google.maps.Map(document.getElementById('map'), map_parameters);
    var marker = new google.maps.Marker({
        position: {
            lat: <?php echo $propiedad["latitud"]; ?>,
            lng: <?php echo $propiedad["longitud"]; ?>
        },
        map: map,
        title: '<?php echo $propiedad["titulo"]; ?>'
    });
</script>