<?php

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1>Titulo de anuncio</h1>


    <!-- Full-width images with number text -->
    <div class="mySlides-gallery">
        <img src="build/img/anuncio1.jpg" style="width:100%">
    </div>

    <div class="mySlides-gallery">
        <img src="build/img/anuncio2.jpg" style="width:100%">
    </div>

    <div class="mySlides-gallery">
        <img src="build/img/anuncio3.jpg" style="width:100%">
    </div>

    <div class="mySlides-gallery">
        <img src="build/img/anuncio4.jpg" style="width:100%">
    </div>

    <div class="mySlides-gallery">
        <img src="build/img/anuncio5.jpg" style="width:100%">
    </div>

    <div class="mySlides-gallery">
        <img src="build/img/anuncio6.jpg" style="width:100%">
    </div>

    <!-- Thumbnail images -->
    <div class="row">
        <div class="column">
            <img class="demo cursor" src="build/img/anuncio1.jpg" style="width:100%" onclick="currentSlide(1)">
        </div>
        <div class="column">
            <img class="demo cursor" src="build/img/anuncio2.jpg" style="width:100%" onclick="currentSlide(2)">
        </div>
        <div class="column">
            <img class="demo cursor" src="build/img/anuncio3.jpg" style="width:100%" onclick="currentSlide(3)">
        </div>
        <div class="column">
            <img class="demo cursor" src="build/img/anuncio4.jpg" style="width:100%" onclick="currentSlide(4)">
        </div>
        <div class="column">
            <img class="demo cursor" src="build/img/anuncio5.jpg" style="width:100%" onclick="currentSlide(5)">
        </div>
        <div class="column">
            <img class="demo cursor" src="build/img/anuncio6.jpg" style="width:100%" onclick="currentSlide(6)">
        </div>
    </div>

    <div class="resumen-propiedad">
        <p class="precio">
            400€/por noche
        </p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
                <p>3</p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" loading="lazy">
                <p>3</p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono habitaciones" loading="lazy">
                <p>3</p>
            </li>
        </ul>

        <h2>Descripción</h2>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni eaque consequatur blanditiis rerum, autem
            facere! Dolorum, doloremque! Recusandae commodi nemo temporibus tempore quisquam! Nostrum iure ducimus
            blanditiis assumenda mollitia incidunt. Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Voluptas, perspiciatis magnam reprehenderit cupiditate nisi vitae sapiente obcaecati culpa esse vero,
            praesentium maxime sit? Id, molestiae quos? Hic eum dolores pariatur.
        </p>
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. A aperiam quis, aliquid error maxime,
            distinctio, illo sapiente commodi nemo aliquam nihil delectus repellendus omnis dolor eius ipsa
            excepturi facere minima!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo aliquam ratione, quia impedit,
            exercitationem sint numquam, quasi eos reiciendis atque vitae! Porro, voluptates. Debitis veritatis sint
            eos cumque expedita earum?
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum laborum fugiat ducimus architecto maxime
            quasi minima accusamus fugit eaque ipsum, libero magni deserunt dolorum nulla quis? Dolor officiis illum
            maxime.
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
            lat: 36.72639109069393,
            lng: -4.443076401628604
        },
        zoom: 17
    };
    var map = new google.maps.Map(document.getElementById('map'), map_parameters);
    var marker = new google.maps.Marker({
        position: {
            lat: 36.72639109069393,
            lng: -4.443076401628604
        },
        map: map,
        title: 'Hello World!'
    });
</script>