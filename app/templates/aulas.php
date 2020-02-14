
<?php ob_start() ?>
<a href="index.php?ctl=logout">Logout</a>
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
                    <td scope="row"> <a class="aulaId" href="index.php?ctl=calendario"> <?php echo $aula['num_aula']?></a></td>
                    <td><?php echo $aula['descripcion_aula'] ?></td>
                    <td >
                        <!--TODO: si es administrador mostrar checkbox -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    window.onload = function(){
        $('.aulaId').click(function(event){
            saveLocalStorage(this.innerText, 'aula');
        });
    }
</script>

<!-- se puede recorrer con un foreach -->
<!-- habrá que ponerlo dentro de un enlace -->
<?php $contenido = ob_get_clean() ?>

<?php include 'layouthome.php' ?>
