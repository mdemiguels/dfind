<?php
require 'includes/config/database.php';
$db = conectarDB();

$select_propiedades = "SELECT p.*, i.imagen FROM propiedad p 
                        JOIN imagen i ON p.idpropiedad = i.propiedad_idpropiedad 
                        WHERE i.destacada = '1' 
                        ORDER BY creado DESC";
$resultado = mysqli_query($db, $select_propiedades);

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <?php include "includes/templates/anuncios.php"; ?>
</main>

<?php
incluirTemplate('footer');
?>