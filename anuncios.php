<?php
require 'includes/config/database.php';
$db = conectarDB();

$select_propiedades = "SELECT p.*, i.imagen FROM propiedad p 
                        JOIN imagen i ON p.idpropiedad = i.propiedad_idpropiedad 
                        WHERE i.destacada = '1' 
                        ORDER BY creado DESC";
$resultado = mysqli_query($db, $select_propiedades);

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">
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
</main>

<?php
incluirTemplate('footer');
?>