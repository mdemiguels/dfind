<?php

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Conoce sobre Nosotros</h1>

    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <img src="build/img/nosotros.jpg" alt="Sobre nosotros">
            </picture>
        </div>

        <div class="texto-nosotros">
            <blockquote>
                Nuestro primer año
            </blockquote>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis dolores nesciunt, quisquam
                exercitationem placeat error aspernatur quia. Ipsam, quis reiciendis nisi, aliquam sunt minus quidem
                voluptates, fugiat fugit quasi quibusdam!
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis dolores nesciunt, quisquam
                exercitationem placeat error aspernatur quia. Ipsam, quis reiciendis nisi, aliquam sunt minus quidem
                voluptates, fugiat fugit quasi quibusdam!
            </p>
        </div>
    </div>
</main>

<section class="contenedor seccion">
    <h1>Más sobre nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Los pagos en nuestra web son completamente seguros y por medio de Paypal.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
            <h3>Precio</h3>
            <p>Vive donde quieras a precios asequibles para todo tipo de clientes o gana dinero poniendo en alquiler
                una propiedad.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
            <h3>Tiempo</h3>
            <p>Los pagos se realizan en el momento y mediante transacción rápida y sencilla.</p>
        </div>
    </div>
</section>

<?php
incluirTemplate('footer');
?>