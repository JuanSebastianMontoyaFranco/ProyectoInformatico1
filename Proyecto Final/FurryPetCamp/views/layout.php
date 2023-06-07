<?php

    if(!isset($_SESSION)) {
        session_start(); 
    }

    $auth = $_SESSION["login"] ?? false;

    if(!isset($inicio)) {
        $inicio = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FurryPetCamp</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.png" alt="Logotipo de FurryPetCamp">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    <nav class="navegacion">
                    <?php
                        if(!$auth): ?>
                        <a class="navegacion-enlace" href="/login">Login</a>
                        <a class="navegacion-enlace" href="/registro">Registro</a>
                        <a class="navegacion-enlace" href="/servicios">Servicios</a>
                        <a class="navegacion-enlace" href="/nosotros">Nosotros</a>
                        <a class="navegacion-enlace" href="/contacto">Contacto</a>
                    <?php endif ;?>
                        <?php if($auth):?>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php
                if($inicio) {
                    echo "<h1>FurryPetCamp, el lugar perfecto para tu fiel canino</h1>";
                }
            ?>
        </div>
    </header>

    <?php echo $contenido; ?>

<footer class="footer seccion">
    <div class="contenedor contenedor-footer">
        <nav class="navegacion">
            <a href="/login">Login</a>
            <a href="/registro">Registro</a>
            <a href="/servicios">Servicios</a>
            <a href="/nosotros">Nosotros</a>
            <a href="/contacto">Contacto</a>
        </nav>
    </div>
    <p class="copyright">Todos los derechos reservados <?php echo date("Y"); ?> &copy;</p>
</footer>
<script src="../build/js/bundle.min.js"></script>
<?php
    echo $script ?? "";
?>
</body>
</html>