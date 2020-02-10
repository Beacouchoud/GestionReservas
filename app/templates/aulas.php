
<?php ob_start() ?>
<div class="col-6 offset-3">
    <!-- aqui pondremos los datos de aulas que sacaremos de la base de datos -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="col-3">Number of Classroom</th>
                <th class="col-8">Description</th>
                <th class="col-1"> <!--TODO: si es administrador mostrar checkbox --></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($params['aulas'] as $aula) :?>
                <tr>
                    <td scope="row"> <a href="index.php?ctl=calendario"> <?php echo $aula['num_aula']?></a></td>
                    <td><?php echo $aula['descripcion_aula'] ?></td>
                    <td >
                        <!--TODO: si es administrador mostrar checkbox -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- se puede recorrer con un foreach -->
<!-- habrá que ponerlo dentro de un enlace -->
<?php $contenido = ob_get_clean() ?>

<?php include 'layouthome.php' ?>
