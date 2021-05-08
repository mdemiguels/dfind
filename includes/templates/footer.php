<?php

if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION["login"] ?? false;

?>
<footer class="footer seccion">

    <div class="contenedor contenedor-footer">

        <nav class="navegacion">
            <?php if ($auth) : ?>
                <a href="reservas.php">Reservas</a>
                <a href="alquileres.php">Alquileres</a>
            <?php endif; ?>
            <a href="anuncios.php">Anuncios</a>
            <a href="blog.php">Blog</a>
            <?php if (!$auth) { ?>
                <a href="login.php">Iniciar sesión</a>
            <?php } else { ?>
                <a href="logout.php">Cerrar sesión</a>
            <?php } ?>
        </nav>

    </div>

    <?php
    $fecha = date('Y');
    ?>

    <p class="copyright">Todos los Derechos Reservados <?php echo $fecha; ?> &copy;</p>

</footer>

<script src="/dfind/build/js/bundle.min.js"></script>

</body>

</html>