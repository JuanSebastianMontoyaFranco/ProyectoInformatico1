<div class="contenedor-anuncios">
    <?php foreach($servicios as $servicio) { ?>
    <div class="anuncio">
        <img loading="lazy" src="/imagenes/<?php echo $servicio->imagen; ?>" alt="anuncio">

        <div class="contenido-anuncio">
            <h3><?php echo $servicio->nombre;?></h3>
            <p><?php echo leerMas($servicio->descripcion, 30);?></p>
            <p class="precio">$<?php echo number_format($servicio->precio);?></p>

            <a href="/servicio?id=<?php echo $servicio->id;?>" class="boton-amarillo-block">Ver Servicio</a>
        </div>
    </div>
    <?php } ?>
</div>