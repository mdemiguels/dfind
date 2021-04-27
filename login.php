<?php include 'includes/templates/header.php'; ?>

    <main class="contenedor seccion">
        
        <div class="login">
            <h1>Iniciar sesión</h1>
            <form class="formulario" action="index.php" method="POST">
                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu Email" id="email">

                <label for="password">Contraseña</label>
                <input type="password" id="password">

                <div class="boton-login">
                    <input type="submit" value="Entrar" class="boton-amarillo">
                    <input type="submit" value="Registrarse" class="boton-verde">
                </div>
            </form>
        </div>

    </main>

<?php  include 'includes/templates/footer.php'; ?>