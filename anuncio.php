<?php

require 'includes/config/database.php';

$db = conectarDB();

$id = $_GET["id"];

$select = "SELECT * FROM propiedad WHERE idpropiedad = $id;";
$result = mysqli_query($db, $select);
if (!$result->num_rows) {
    header("Location: /dfind/");
}
$propiedad = mysqli_fetch_assoc($result);



$select = "SELECT * FROM imagen WHERE propiedad_idpropiedad = $id ORDER BY destacada DESC;";
$result = mysqli_query($db, $select);
$cont = 1;

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad["titulo"]; ?></h1>


    <!-- Full-width images with number text -->
    <?php while ($imagen = mysqli_fetch_assoc($result)) : ?>
        <div class="mySlides-gallery">
            <img src="img_propiedades/<?php echo $imagen["imagen"]; ?>" style="width:100%">
        </div>

        <!-- Thumbnail images -->
        <div class="row">
            <div class="column">
                <img class="demo cursor" src="img_propiedades/<?php echo $imagen["imagen"]; ?>" style="width:100%" onclick="currentSlide(<?php echo $cont; ?>)">
            </div>
        </div>
    <?php
        $cont++;
    endwhile;
    ?>

    <div class="resumen-propiedad">
        <p class="precio">
            <?php echo $propiedad["precio"]; ?> €
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
        <form class="formulario formulario-reserva" action="pago.php" method="POST">
            <div class="reserva">
                <div>
                    <label for="date">Fecha inicio:</label>

                    <input type="date" min="<?php echo date("Y-m-d"); ?>">
                </div>

                <div>
                    <label for="date">Fecha fin:</label>
                    <input type="date">
                </div>
            </div>
            <div class="contenedor-boton-reserva">
                <input class="boton-verde-block" type="submit" value="Reservar">
            </div>


        </form>
    </div>

    <h2>Comentarios</h2>
    <div class="contenedor seccion">
        
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