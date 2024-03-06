<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Registro Oferta Academica</h2>
    <div class="row" >
        <div class="col text-right">
            <a href="oferta/new" class="btn btn-success "><i class="bi bi-cloud-plus"></i> Nuevo Registro</a>
            <a href="oferta/subir" class="btn btn-primary "><i class="bi bi-cloud-upload-fill"></i> Subir Archivo</a>
        </div>
    </div>
    <br><br>
    <table class='table table-bordered table-striped table-hover'>
        <thead>
            <tr>
                <td>Id</td>
                <td>Ciclo</td>
                <td>Asignatura</td>
                <td>Inscritos</td>
                <td>Aula</td>
                <td>Seccion</td>
                <td>Horario</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                if($todos): 
                    foreach($todos as $data):
            ?>
                    <tr>
                        <td><?= $data->id ?></td>
                        <td><?= $data->asignatura ?></td>
                        <td><?= $data->ciclo ?> - <?= $data->anio ?></td>
                        <td><?= $data->inscritos ?></td>
                        <td><?= $data->aula ?></td>
                        <td><?= $data->seccion ?></td>
                        <td><?= $data->horario ?></td>
                        <td>
                            <a href="oferta/edit/<?= $data->id ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                            <button onclick="Eliminar(<?= $data->id ?>)" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>           
            <?php 
                    endforeach;
                endif;
            ?>
        </tbody>
    </table>
    <script>
        function Eliminar(id){
            Swal.fire({
                title: "Esta seguro de Eliminar este registro?",
                text: "La eliminacion es permanente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirmar",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('academico/oferta/delete');?>/"+id,          
                        type: "get",
                        dataType: "json",
                        //data: 
                        success: function(data) { 
                            location.reload();
                        }
                    });
                }
            });
        }
    </script>
<?= $this->endSection() ?>