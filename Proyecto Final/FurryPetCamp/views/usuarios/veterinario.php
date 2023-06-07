<main class="contenedor seccion">
    <h1>Citas de Veterinaria</h1>
    <div class="busqueda">
    <a href="/veterinario" class="boton boton-verde">Volver</a>

    <p>

    </p>

        <form class="formulario">
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
            </div>
        </form>
    </div>

    <?php
        if(count($citas) === 0) {
            echo "<h2>No hay citas en esta fecha</h2>";
        }
    ?>

    <div class="citas-admin">
        <ul class="citas">
        <?php
        $idcita = 0;
           foreach($citas as $cita) {
               if($idcita !== $cita->id) {
        ?>
        <li>
            <h3>Información del cliente:</h3>
            <p>ID: <span><?php echo $cita->id; ?></span></p>
            <p>Hora: <span><?php echo $cita->hora; ?></span></p>
            <p>Canino: <span><?php echo $cita->canino; ?></span></p>
            <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
            <p>Email: <span><?php echo $cita->email; ?></span></p>
            <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>

            <h3>Servicios:</h3>
        <?php 
        $idcita = $cita->id;
        } //Fin IF ?>
            <p class="servicio"><?php echo $cita->servicio; ?></p>
            <p class="total">Valor a pagar: <span>$<?php echo number_format($cita->precio); ?></span></p>

            <form action="/api/eliminarVeterinario" method="POST">
                <input type="hidden" name="id" value="<?php echo $cita->id; ?>">

                <input type="submit" class="boton-rojo-block" value="Eliminar">
            </form>
        </li>
        <?php } //Fin foreach ?>
        </ul>
    </div>
</main>
<script>

document.addEventListener("DOMContentLoaded", function() {
    iniciarApp2();
});

function iniciarApp2() {
    buscarPorFecha();
}

function buscarPorFecha() {
    const fechaInput = document.querySelector("#fecha");
    fechaInput.addEventListener("input", function(e) {
        const fechaSeleccionada = e.target.value;
        window.location = `?fecha=${fechaSeleccionada}`;
    });
}
</script>