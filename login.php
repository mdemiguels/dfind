<?php

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">

    <div class="login">
        <h1>Iniciar sesión</h1>
        <form class="formulario formulario-login" action="index.php" method="POST">
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email">

            <label for="password">Contraseña</label>
            <input type="password" id="password">

            <div class="boton-login">
                <input type="submit" value="Entrar" class="boton-amarillo">
                <a href="registro.php" class="boton-verde">Resgistrarse</a>
            </div>
        </form>
    </div>

</main>

<?php
    incluirTemplate('footer');
?>