<main class="contenedor seccion">
        <h1>Administrador de FurryPetCamp</h1>
        <?php
        if($resultado) {
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje) { ?>
                <p class="alerta exito"><?php echo s($mensaje); ?></p>
            <?php }
        }
        ?>
        <a href="/admin" class="boton boton-verde">Volver</a>
        <a href="/usuarios/crear" class="boton boton-verde">Nuevo usuario</a>

        <h2>Nuestros Usuarios</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!--.Mostrar los resultados -->
                <?php foreach($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario->id; ?></td>
                    <td><?php echo $usuario->nombre . " " . $usuario->apellido; ?></td>
                    <td> <img src="/imagenes/<?php echo $usuario->imagen; ?>" class="imagen-tabla"></td>
                    <td><?php echo $usuario->rol_id; ?> </td>
                    <td>
                        <form method="POST" class="w-100" action="/usuarios/eliminar">

                            <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                            <input type="hidden" name="tipo" value="usuario">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="/usuarios/actualizar?id=<?php echo $usuario->id; ?>" 
                        class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</main>