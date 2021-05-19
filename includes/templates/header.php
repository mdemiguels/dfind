<?php

if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION["login"] ?? false;

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dfind</title>
    <link rel="stylesheet" href="/dfind/build/css/app.css">
    <link rel="shortcut icon" href="/dfind/build/img/fav.ico" />
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : '';  ?>">

        <div class="contenedor contenido-header">

            <div class="barra">
                <a href="/dfind/">
                    <img src="/dfind/build/img/logo.svg" alt="Logotipo de dfind">
                </a>

                <div class="mobile-menu">
                    <img src="/dfind/build/img/barras.svg" alt="Icono menu responsive">
                </div>

                <div class="derecha">
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

            </div> <!-- div barra -->

        </div>

    </header>