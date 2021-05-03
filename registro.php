<?php
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
}

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Registro</h1>

    <div class="login">
        <h1>Formulario de registro</h1>
        <form class="formulario formulario-login" action="index.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre">

            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email">


            <label for="password">Contraseña</label>
            <input type="password" id="password">

            <label for="password_r">Repita la contraseña</label>
            <input type="password" id="password_r">

            <input type="submit" value="Crear" class="boton-verde">

        </form>
    </div>
</main>

<?php
incluirTemplate('footer');
?>