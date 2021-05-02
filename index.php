<?php

require 'includes/funciones.php';

incluirTemplate('header', $inicio = true);

?>

<main class="contenedor seccion">
    <h1>Más sobre nosotros</h1>

    <!-- Slideshow container -->
    <div class="slideshow-container">

        <div class="mySlides fade">
            <img src="build/img/destacada.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="build/img/destacada2.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="build/img/destacada3.jpg" style="width:100%">
        </div>
    </div>
    <br>

</main>

<section class="seccion contenedor">
    <h2>Añadidas recientemente</h2>

    <div class="contenedor-anuncios">
        <div class="anuncio">
            <picture>
                <source srcset="build/img/anuncio1.webp" type="image/webp">
                <source srcset="build/img/anuncio1.jpg" type="image/jpeg">
                <img src="build/img/anuncio1.jpg" alt="Anuncio">
            </picture>

            <div class="contenido-anuncio">
                <h3>Anuncio ejemplo</h3>
                <p>Este es la breve descripcion del anuncio</p>
                <p class="precio">400€</p>
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
                <a href="anuncio.php" class="boton-amarillo-block">Ver Propiedad</a>

            </div><!-- .contenido-anuncio -->
        </div><!-- anuncio -->

        <div class="anuncio">
            <picture>
                <source srcset="build/img/anuncio2.webp" type="image/webp">
                <source srcset="build/img/anuncio2.jpg" type="image/jpeg">
                <img src="build/img/anuncio2.jpg" alt="Anuncio">
            </picture>

            <div class="contenido-anuncio">
                <h3>Anuncio ejemplo</h3>
                <p>Este es la breve descripcion del anuncio</p>
                <p class="precio">400€</p>
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
                <a href="anuncio.php" class="boton-amarillo-block">Ver Propiedad</a>

            </div><!-- .contenido-anuncio -->
        </div><!-- anuncio -->
        <div class="anuncio">
            <picture>
                <source srcset="build/img/anuncio3.webp" type="image/webp">
                <source srcset="build/img/anuncio3.jpg" type="image/jpeg">
                <img src="build/img/anuncio3.jpg" alt="Anuncio">
            </picture>

            <div class="contenido-anuncio">
                <h3>Anuncio ejemplo</h3>
                <p>Este es la breve descripcion del anuncio</p>
                <p class="precio">400€</p>
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
                <a href="anuncio.php" class="boton-amarillo-block">Ver Propiedad</a>

            </div><!-- .contenido-anuncio -->
        </div><!-- anuncio -->

    </div><!-- coontenedor-anuncios -->

    <div class="alinear-derecha">
        <a href="anuncios.php" class="boton-verde">Ver Todas</a>
    </div>

</section>

<section class="imagen-contacto">
    <h2>¿Necesitas ayuda?</h2>
    <p>Rellena el formulario de contacto y un administrador se pondrá en contacto contigo lo antes posible</p>
    <a href="contacto.php" class="boton-amarillo">Contáctanos</a>
</section>

<div class="contenedor seccion">
    <section class="blog">
        <h3>Últimos posts de nuestro blog</h3>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img src="build/img/blog1.jpg" alt="Texto entrada blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el: <span>20/20/2021</span> por: <span>Admin</span></p>

                    <p>
                        Cosejos para construir una terraza en el techo de tu casa con los mejores materiales y
                        ahorrando dinero.
                    </p>
                </a>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img src="build/img/blog2.jpg" alt="Texto entrada blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía de decoración de tu hogar</h4>
                    <p class="informacion-meta">Escrito el: <span>20/20/2021</span> por: <span>Admin</span></p>

                    <p>
                        Cosejos para construir una terraza en el techo de tu casa con los mejores materiales y
                        ahorrando dinero.
                    </p>
                </a>
            </div>
        </article>
    </section>


</div>

<?php
incluirTemplate('footer');
?>

<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 5000); // Change image every 5 seconds
    }
</script>