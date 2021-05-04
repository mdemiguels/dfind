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
                <a href="index.php">
                    <img src="/dfind/build/img/logo.svg" alt="Logotipo de dfind">
                </a>

                <div class="mobile-menu">
                    <img src="/dfind/build/img/barras.svg" alt="Icono menu responsive">
                </div>

                <div class="derecha">
                    <nav class="navegacion">
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="login.php">Iniciar sesión</a>
                    </nav>
                </div>

            </div> <!-- div barra -->

        </div>

    </header>