<main class="contenedor seccion texto-centrado">
    <h1><?php echo $servicio->nombre; ?></h1>
    <img class="equisde" loading="lazy" src="/imagenes/<?php echo $servicio->imagen; ?>" alt="imagen del servicio">
    <div>
        <p class="precio">$<?php echo number_format($servicio->precio) ;?></p>
        <?php echo $servicio->descripcion ;?>
    </div>
</main>