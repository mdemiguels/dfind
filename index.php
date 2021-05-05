<?php
require 'includes/config/database.php';
$db = conectarDB();

$select_propiedades = "SELECT p.*, i.imagen FROM propiedad p 
                        JOIN imagen i ON p.idpropiedad = i.propiedad_idpropiedad 
                        WHERE i.destacada = '1' 
                        ORDER BY creado DESC LIMIT 3";
$resultado = mysqli_query($db, $select_propiedades);

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
        <?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
            <div class="anuncio">
                <img src="img_propiedades/<?php echo $propiedad["imagen"] ?>" alt="Anuncio">

                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad["titulo"] ?></h3>
                    <p><?php echo $propiedad["descripcion"] ?></p>
                    <p class="precio"><?php echo $propiedad["precio"] ?> €</p>
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
                            <p><?php echo $propiedad["wc"] ?></p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" loading="lazy">
                            <p><?php echo $propiedad["estacionamiento"] ?></p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono habitaciones" loading="lazy">
                            <p><?php echo $propiedad["habitaciones"] ?></p>
                        </li>
                    </ul>
                    <a href="anuncio.php" class="boton-amarillo-block">Ver Propiedad</a>

                </div><!-- .contenido-anuncio -->
            </div><!-- anuncio -->
        <?php endwhile; ?>

    </div><!-- coontenedor-anuncios -->

    <div class="alinear-derecha">
        <a href="anuncios.php" class="boton-verde">Ver Todas</a>
    </div>

</section>

<section class="imagen-contacto">
    <h2>¿Necesitas ayuda?</h2>
    <p>Rellena el formulario de contacto y un administrador se pondrá en contacto contigo lo antes posible</p>
    <a href="mailto:faq@dfind.com" class="boton-amarillo">Contáctanos</a>
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