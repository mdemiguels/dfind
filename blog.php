<?php
require 'includes/config/database.php';
require 'includes/funciones.php';

$db = conectarDB();

incluirTemplate('header');

$query = "SELECT * FROM blog";
$resultado = mysqli_query($db, $query);


?>

<main class="contenedor seccion contenido-centrado">
    <h1>Nuestro Blog</h1>

    <?php include "includes/templates/entradas.php"; ?>

</main>

<?php
incluirTemplate('footer');
?>