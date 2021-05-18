<?php
require 'includes/config/database.php';
require 'includes/funciones.php';

$db = conectarDB();
$id = $_GET["id"] ?? null;

$query = "SELECT * FROM blog WHERE idblog=$id;";
$resultado = mysqli_query($db, $query);
$blog = mysqli_fetch_assoc($resultado);

incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $blog["titulo"]; ?></h1>

    <img src="img_blog/<?php echo $blog["imagen"]; ?>" alt="Imagen de blog" loading="lazy">
    <?php
    $fecha = date_format(date_create($blog["fecha_creado"]), "d-m-Y");
    ?>
    <p class="informacion-meta">Escrito el: <span><?php echo $fecha; ?></span> por: <span>Admin</span></p>

    <div class="resumen-propiedad">
        <p>
            <?php echo $blog["contenido"]; ?>
        </p>
    </div>
</main>


<?php
incluirTemplate('footer');
?>