<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php 
        include __DIR__ . "/../templates/errores.php";
        ?>

        <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email"name="email" placeholder="Tu Email" id="email" >

            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Tu Contraseña" id="password" >

        </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>
    