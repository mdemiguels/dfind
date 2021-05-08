<?php
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

$nombre = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errores = []; // Reinicio de la variable errores

    $nombre = mysqli_real_escape_string($db, $_POST["nombre"]);
    $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST["password"]);

    if (!$email) {
        $errores[] = "Debe introducir un email válido";
    }

    if (!$password) {
        $errores[] = "Debe introducir una contraseña";
    }

    $select = "SELECT * FROM usuario WHERE correo='$email'";
    $resultado = mysqli_query($db, $select);

    if ($resultado->num_rows === 0) {
        if (strlen($password) < 9) {
            $errores[] = "La contraseña debe ser de al menos 9 caracteres";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $insert = "INSERT INTO usuario (nombre, correo, password) VALUES ('$nombre', '$email', '$password_hash');";
            $result = mysqli_query($db, $insert);
            
            header("Location: login.php");
        }
    } else {
        $errores[] = "El usuario ya existe";
    }
}

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">

    <div class="login">
        <h1>Formulario de registro</h1>

        <?php
        foreach ($errores as $error) {
            echo "<div class='alerta error'>";
            echo $error;
            echo "</div>";
        }
        ?>

        <form class="formulario formulario-login" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="nombre">

            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="email">


            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password">

            <input type="submit" value="Crear" class="boton-verde">

        </form>
    </div>
</main>

<?php
incluirTemplate('footer');
?>