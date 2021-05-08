<?php

require 'includes/config/database.php';
$db = conectarDB();

$nombre = "Miguel";
$email = "correo@correo.com";
$password = "P@ssw0rd";
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$insert = "INSERT INTO usuario (nombre, correo, password) VALUES ('$nombre', '$email', '$password_hash');";
$result = mysqli_query($db, $insert);


?>