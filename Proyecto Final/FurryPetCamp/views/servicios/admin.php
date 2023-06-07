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


        <a href="/servicios/crear" class="boton boton-verde">Nuevo Servicio</a>
        <a href="/usuarios/admin" class="boton boton-amarillo">Usuarios</a>
        <a href="/usuarios/citas" class="boton boton-amarillo">Citas</a>

        <h2>Nuestros Servicios</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!--.Mostrar los resultados -->
                <?php foreach($servicios as $servicio): ?>
                <tr>
                    <td><?php echo $servicio->id; ?></td>
                    <td><?php echo $servicio->nombre; ?></td>
                    <td> <img src="/imagenes/<?php echo $servicio->imagen; ?>" class="imagen-tabla"></td>
                    <td><?php echo number_format($servicio->precio); ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/servicios/eliminar">

                        <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                        <input type="hidden" name="tipo" value="servicio">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/servicios/actualizar?id=<?php echo $servicio->id; ?>" 
                        class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</main>