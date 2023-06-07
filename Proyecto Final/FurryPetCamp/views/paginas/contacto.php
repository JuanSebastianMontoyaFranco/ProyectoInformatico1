<main class="contenedor seccion">
    <h1>Contacto</h1>

    <?php if($mensaje) { ?>
             <p class="alerta exito"> <?php echo $mensaje; ?></p>;
    <?php } ?>

    <picture class="recorte">
        <source srcset="build/img/contacto.webp" type="image/webp">
        <source srcset="build/img/contacto.jpg" type="image/jpeg">
        <img class="contacto" loading="lazy" src="build/img/contacto.jpg" alt="Imagen Contacto">
    </picture>

    <h2>Llene el formulario de contacto</h2>
    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]">

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="contacto[mensaje]" ></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de Contacto</legend>
            <p>
                ¿Cómo desea ser contactado?
            </p>
            <div class="forma-contacto">
            <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" >

                <label for="contactar-email">E-Mail</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" >
            </div>
            <div id="contacto"></div>
        </fieldset>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>