<?php
require 'includes/config/database.php';
require 'includes/funciones.php';

$db = conectarDB();

incluirTemplate('header');

$query = "SELECT * FROM blog";
$resultado = mysqli_query($db, $query);

$registrado = $_GET["registrado"] ?? null;

?>

<main class="contenedor seccion contenido-centrado">
    <h1>Nuestro Blog</h1>

    <?php if (intval($registrado) === 1) : ?>
        <p class="alerta exito">Post creado con éxito</p>
    <?php endif; ?>

    <?php 
    if ( isset($_SESSION["admin"]) ) {
        echo '<a class="boton boton-verde" href="crear-post.php">Nuevo Post</a>';
    }
    include "includes/templates/entradas.php"; 
    
    ?>

</main>

<?php
incluirTemplate('footer');
?>