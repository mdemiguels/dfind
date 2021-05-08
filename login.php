<?php
require 'includes/config/database.php';

$db = conectarDB(); // Conexión con la Base de datos

$errores = [];

// Recepción de los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errores = []; // Reinicio de la variable errores

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

    if ($resultado->num_rows) {
        $usuario = mysqli_fetch_assoc($resultado);
        $auth = password_verify($password, $usuario["password"]);
        
        if ($auth) {
            session_start();

            $_SESSION["login"] = true;
            $_SESSION["id"] = $usuario["idusuario"];
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["email"] = $usuario["correo"];

            header("Location: index.php");
        }else {
            $errores[] = "La contraseña no es correcta";
        }
    } else {
        $errores[] = "El usuario no existe";
    }
}

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">

    <div class="login">
        <h1>Iniciar sesión</h1>

        <?php
        foreach ($errores as $error) {
            echo "<div class='alerta error'>";
            echo $error;
            echo "</div>";
        }
        ?>

        <form class="formulario formulario-login" method="POST">
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