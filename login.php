<?php
require 'includes/config/database.php';

$db = conectarDB(); // Conexión con la Base de datos

$errores = [];

$email = '';
$password = '';

// Recepción de los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errores = []; // Reinicio de la variable errores

    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
}

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">

    <div class="login">
        <h1>Iniciar sesión</h1>
        <form class="formulario formulario-login" action="index.php" method="POST">
            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu Email" id="email">

            <label for="password">Contraseña</label>
            <input type="password" name="password">

            <div class="boton-login">
                <input type="submit" value="Entrar" class="boton boton-amarillo">
                <a href="registro.php" class="boton boton-verde">Resgistrarse</a>
            </div>
        </form>
    </div>

</main>

<?php
incluirTemplate('footer');
?>