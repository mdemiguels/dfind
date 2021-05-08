<?php

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1>Titulo de post de blog</h1>

    <picture>
        <source srcset="build/img/blog2.webp" type="image/webp">
        <source srcset="build/img/blog2.jpg" type="image/jpeg">
        <img src="build/img/blog2.jpg" alt="Imagen de la propiedad" loading="lazy">
    </picture>

    <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

    <div class="resumen-propiedad">
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
</main>


<?php
incluirTemplate('footer');
?>