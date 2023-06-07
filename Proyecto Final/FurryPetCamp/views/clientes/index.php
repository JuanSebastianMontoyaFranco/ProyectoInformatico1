<main class="contenedor seccion">
    <h1>Bienvenid@ <?php echo $nombre; ?></h1>

    <?php
        if($resultado) {
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje) { ?>
                <p class="alerta exito"><?php echo s($mensaje); ?></p>
            <?php }
        }
    ?>

    <a href="/cliente/canino" class="boton boton-verde">Nuevo Canino</a>
    <a href="/cliente/citas" class="boton boton-amarillo">Mis Citas</a>
    <p class="centrar">Elige tus servicios y coloca tus datos</p>

    
    <div id="app">
        <nav class="tabs">
            <button class="actual" type="button" data-paso="1">Servicios</button>
            <button type="button" data-paso="2">Información Cita</button>
            <button type="button" data-paso="3">Resumen</button>
        </nav>

        <div id="paso-1" class="seccionUno">
            <h2>Servicios</h2>
            <p class="text-center">Elige tus servicios a continuación</p>
            <div id="servicios" class="listado-servicios"></div>
        </div>

        <div id="paso-2" class="seccionUno">
            <h2>Tus Datos y Citas</h2>
            <p class="text-center">Coloca tus datos y fecha de tu cita</p>

            <form class="formulario">
                <div class="campo">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" type="text" placeholder="Tu Nombre" value="<?php echo $nombre; ?>" disabled>
                </div>

                <div class="campo">
                    <label for="fecha">Fecha</label>
                    <input id="fecha" type="date" min="<?php echo date("Y-m-d", strtotime("+1 day")); ?>">
                </div>

                <div class="campo">
                    <label for="hora">Hora</label>
                    <input id="hora" type="time">
                </div>

                <input type="hidden" id="id" value="<?php echo $id; ?>">

                <label for="caninos">Caninos</label>
                <select name="canino" id="canino">
                <option selected value="">Seleccionar</option>
                    <?php foreach($caninos as $canino) { ?>
                        <option value="canino"><?php echo $canino->nombre; ?></option>
                    <?php } ?>
                </select>
            </form>
        </div>

        <div id="paso-3" class="seccionUno contenido-resumen">
            <h2>Resumen</h2>
            <p class="text-center">Verifica que la infromacion sea correcta</p>
        </div>

        <div class="paginacion">
            <button id="anterior" class="boton-verde">&laquo; Anterior</button>
            <button id="siguiente" class="boton-verde"> Siguiente &raquo;</button>
        </div>
    </div>

    <h2>Mis Caninos</h2>
    <table class="propiedades">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach($caninos as $canino): ?>
    <tr>
        <td><?php echo $canino->nombre; ?></td>
        <td>
            <form method="POST" class="w-100" action="/caninos/eliminar">
                <input type="hidden" name="id" value="<?php echo $canino->id; ?>">
                <input type="hidden" name="tipo" value="canino">
                <input type="submit" class="boton-rojo-block" value="Eliminar">
            </form>
            <a href="/caninos/actualizar?id=<?php echo $canino->id; ?>" 
                        class="boton-amarillo-block">Actualizar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>


</main>

<?php
    $script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>
";
?>
