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
    <h2>Más sobre nosotros</h2>

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

    <?php include "includes/templates/anuncios.php"; ?>

    <div class="alinear-derecha">
        <a href="anuncios.php" class="boton-verde">Ver Todas</a>
    </div>

</section>

<section class="imagen-contacto">
    <h2>¿Necesitas ayuda?</h2>
    <p>Rellena el formulario de contacto y un administrador se pondrá en contacto contigo lo antes posible</p>
    <a href="mailto:faq@dfind.com" class="boton-amarillo">Contáctanos</a>
</section>

<?php
$query = "SELECT * FROM blog LIMIT 3";
$resultado = mysqli_query($db, $query);

?>

<div class="contenedor seccion">
    <section class="blog">
        <h3>Últimos posts de nuestro blog</h3>
        <?php include "includes/templates/entradas.php"; ?>
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