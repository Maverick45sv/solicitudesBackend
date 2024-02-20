<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Registro Proceso</h2>
    <div class="row" >
        <div class="col text-right">
            <a href="proceso/new" class="btn btn-success "><i class="bi bi-cloud-plus"></i> Nuevo Registro</a>
        </div>
    </div>
    <br><br>
    <table class='table table-bordered table-striped table-hover'>
        <thead>
            <tr>
                <td>Id</td>
                <td>Codigo</td>
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Verificar Cupo</td>
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
                        <td><?= $data->codigo ?></td>
                        <td><?= $data->nombre ?></td>
                        <td><?= $data->descripcion ?></td>
                        <td>
                            <?php if ($data->verificar_cupo): ?>
                                SI
                            <?php else: ?>
                                NO
                            <?php endif; ?>                             
                        </td>
                        <td>
                            <a href="procesoEstacion/list/<?= $data->id ?>" class="btn btn-success"><i class="bi bi-list-ol"></i></a>
                            <a href="proceso/edit/<?= $data->id ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
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
                        url: "<?= base_url('telemetria/proceso/delete');?>/"+id,          
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