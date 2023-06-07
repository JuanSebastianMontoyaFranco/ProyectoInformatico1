<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="servicio[nombre]" placeholder="Nombre del Servicio" value="<?php echo s($servicio->nombre) ;?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="servicio[precio]" placeholder="Precio del Servicio" value="<?php echo s($servicio->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="servicio[imagen]">

    <?php if($servicio->imagen) { ?>
        <img src="/imagenes/<?php echo $servicio->imagen ;?>" class="imagen-small">
   <?php } ?>

   <label for="descripcion">Descripción:</label>
   <textarea id="descripcion" name="servicio[descripcion]"><?php echo s($servicio->descripcion); ?></textarea>
</fieldset>