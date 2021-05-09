<div class="contenedor-anuncios">
        <?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
            <div class="anuncio">
                <img src="img_propiedades/<?php echo $propiedad["imagen"] ?>" alt="Anuncio">

                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad["titulo"] ?></h3>
                    <?php if (strlen($propiedad["descripcion"]) > 75) {
                        $propiedad["descripcion"] = substr($propiedad["descripcion"], 0, 75)."...";  
                    } 
                    ?>
                    <p><?php echo $propiedad["descripcion"] ?></p>
                    <p class="precio"><?php echo $propiedad["precio"] ?> € / por día</p>
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
                    <a href="anuncio.php?id=<?php echo $propiedad["idpropiedad"];?>" class="boton-amarillo-block">Ver Propiedad</a>

                </div><!-- .contenido-anuncio -->
            </div><!-- anuncio -->
        <?php endwhile; ?>

    </div><!-- coontenedor-anuncios -->