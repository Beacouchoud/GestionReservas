<?php ob_start() ?>
<a href="index.php?ctl=logout">Logout</a>
<!-- aqui pondremos El horario -->
<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
