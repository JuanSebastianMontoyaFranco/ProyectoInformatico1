<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="usuario[nombre]" placeholder="Nombre del Usuario" value="<?php echo s($usuario->nombre);?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="usuario[apellido]" placeholder="Apellido del Usuario" value="<?php echo s($usuario->apellido);?>">

    <label for="cedula">Cedula:</label>
    <input type="number" id="cedula" name="usuario[cedula]" placeholder="Cedula del Usuario" value="<?php echo s($usuario->cedula);?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="usuario[imagen]">

    <?php if($usuario->imagen) { ?>
        <img src="/imagenes/<?php echo $usuario->imagen ;?>" class="imagen-small">
   <?php } ?>

    <label for="telefono">Teléfono:</label>
    <input type="number" id="telefono" name="usuario[telefono]" placeholder="Telefono del Usuario" value="<?php echo s($usuario->telefono);?>">

    <label for="email">Correo Electrónico:</label>
    <input type="text" id="email" name="usuario[email]" placeholder="Correo Electrónico del Usuario" value="<?php echo s($usuario->email);?>">

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="usuario[password]" placeholder="Contraseña">
</fieldset>

<fieldset>
    <legend>Rol del Usuario</legend>
    <label for="Rol">Rol:</label>
    <select name="usuario[rol_id]" id="rol">
        <option selected value="">>--Seleccionar--<</option>
        <?php foreach ($roles as $rol) { ?>
            <option <?php echo $usuario->rol_id === $rol->id ? "selected" : ""; ?> 
            value="<?php echo s($rol->id); ?>"><?php echo s($rol->nombre) ?>
            </option>
        <?php } ?>
    </select>
</fieldset>