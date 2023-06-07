<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="registro[nombre]" placeholder="Nombre del Usuario" value="<?php echo s($registro->nombre);?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="registro[apellido]" placeholder="Apellido del Usuario" value="<?php echo s($registro->apellido);?>">

    <label for="cedula">Cedula:</label>
    <input type="number" maxlength="10" id="cedula" name="registro[cedula]" placeholder="Cedula del Usuario" value="<?php echo s($registro->cedula);?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="registro[imagen]">

    <?php if($registro->imagen) { ?>
        <img src="/imagenes/<?php echo $registro->imagen ;?>" class="imagen-small">
   <?php } ?>

    <label for="telefono">Teléfono:</label>
    <input type="number" id="telefono" name="registro[telefono]" placeholder="Telefono del Usuario" value="<?php echo s($registro->telefono);?>">

    <label for="email">Correo Electrónico:</label>
    <input type="text" id="email" name="registro[email]" placeholder="Correo Electrónico del Usuario" value="<?php echo s($registro->email);?>">

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="registro[password]" placeholder="Contraseña">
</fieldset>