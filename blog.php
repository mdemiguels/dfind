<?php

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1>Nuestro Blog</h1>

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
    <article class="entrada-blog">
        <div class="imagen">
            <picture>
                <source srcset="build/img/blog3.webp" type="image/webp">
                <source srcset="build/img/blog3.jpg" type="image/jpeg">
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
                <source srcset="build/img/blog4.webp" type="image/webp">
                <source srcset="build/img/blog4.jpg" type="image/jpeg">
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
</main>

<?php
    incluirTemplate('footer');
?>