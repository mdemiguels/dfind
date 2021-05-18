<?php while ($blog = mysqli_fetch_assoc($resultado)) : ?>
    <article class="entrada-blog">
        <div class="imagen">
            <img src="img_blog/<?php echo $blog['imagen']; ?>" alt="Texto entrada blog">
        </div>
        <div class="texto-entrada">
            <a href="entrada.php?id=<?php echo $blog["idblog"]; ?>">
                <h4><?php echo $blog["titulo"]; ?></h4>
                <?php
                $fecha = date_format(date_create($blog["fecha_creado"]), "d-m-Y");
                ?>
                <p class="informacion-meta">Escrito el: <span><?php echo $fecha; ?></span> por: <span>Admin</span></p>
                <?php if (strlen($blog["contenido"]) > 100) {
                    $blog["contenido"] = substr($blog["contenido"], 0, 100) . "...";
                }
                ?>
                <p>
                    <?php echo $blog["contenido"]; ?>
                </p>
            </a>
        </div>
    </article>
<?php endwhile; ?>