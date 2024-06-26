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
                <td>Color</td>
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
                        <td><input type="color"  name="color" value="<?= $data->color ?>" disabled></td>
                        <td>
                            <a href="proceso/estacion/<?= $data->id ?>" class="btn btn-success" title="Estaciones"><i class="bi bi-list-ol"></i></a>
                            <a href="proceso/tipodocumento/<?= $data->id ?>" class="btn btn-info" title="Documentos"><i class="bi bi-file-earmark-plus"></i></a>
                            <a href="proceso/atributo/<?= $data->id ?>" class="btn btn-warning" title="Atributos"><i class="bi bi-terminal-plus"></i></a>
                            <a href="proceso/rol/<?= $data->id ?>" class="btn btn-default" title="Roles"><i class="bi bi-person-rolodex"></i></a>
                            <a href="proceso/edit/<?= $data->id ?>" class="btn btn-primary" title="Modificar"><i class="bi bi-pencil-square"></i></a>
                            <button onclick="Eliminar(<?= $data->id ?>)" class="btn btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
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