<?php foreach($errores as $error): ?>
            <div class="alerta error"> 
                <?php echo $error?>
            </div>
        <?php endforeach; ?>


        <?php foreach($errores as $key => $mensajes):
            foreach($mensajes as $mensaje):
        ?>

            <div class="alerta error <?php echo $key; ?>"> 
                <?php echo $mensaje; ?>
            </div>
        <?php 
                endforeach;
            endforeach;
        ?>







<h2>Mis Caninos</h2>
<table class="propiedades">
    <thead>
        <tr>
            <th>Nombre</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach($caninos as $canino): ?>
    <tr>
        <td><?php echo $canino->nombre; ?></td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>

<fieldset>
<select>
    <option selected value="">Seleccionar</option>
    <?php foreach($caninos as $canino) { ?>
    <option><?php echo $canino->nombre; ?></option>
    <?php } ?>
</select>
</fieldset>


document.addEventListener("DOMContentLoaded", function() {
    iniciarApp();
});

function iniciarApp() {
    buscarPorFecha();
}

function buscarPorFecha() {
    const fechaInput = document.querySelector("#fecha");
    fechaInput.addEventListener("input", function(e) {
        const fechaSeleccionada = e.target.value;

        window.location = `?fecha=${fechaSeleccionada}`;
    });
}