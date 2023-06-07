<fieldset>
    <legend>Información de tu Canino</legend>
    <label for="nombre">Nombre del Canino:</label>
    <input type="text" id="nombre" name="canino[nombre]" placeholder="Nombre del Canino" value="<?php echo s($canino->nombre);?>">

    <label for="nombre">Raza:</label>
    <input type="text" id="raza" name="canino[raza]" placeholder="Raza del Canino" value="<?php echo s($canino->raza);?>">
    
    <label for="edad">Edad:</label>
    <input type="number" id="edad" name="canino[edad]" placeholder="Edad del Canino" value="<?php echo s($canino->edad);?>">

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="canino[descripcion]" value="<?php echo s($canino->descripcion);?>">
    
</fieldset>