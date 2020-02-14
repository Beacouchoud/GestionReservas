<?php ob_start() ?>
<a href="index.php?ctl=logout">Logout</a>
<!-- aqui pondremos los datos usuarios que sacaremos de la base de datos -->
<?php $contenido = ob_get_clean() ?>

<?php include 'layouthome.php' ?>
