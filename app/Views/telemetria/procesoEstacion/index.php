<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Registro Estacion de Proceso <?= $proceso->nombre ?></h2>
    <div class="row" >
        <div class="col text-right">
            <a href="<?= base_url('telemetria/proceso/estacion/new/'.$proceso->id) ?>" class="btn btn-success "><i class="bi bi-cloud-plus"></i> Nuevo Registro</a>
        </div>
    </div>
    <br><br>
    <table class='table table-bordered table-striped table-hover'>
        <thead>
            <tr>
                <td>Id</td>               
                <td>Estacion</td>
                <td>Ruta</td>
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
                        <td><?= $data->estacion ?></td>
                        <td><?= $data->ruta ?></td>                       
                        <td>
                            <button type="button" class="btn btn-success" onclick="show(<?= $data->id ?>)"><i class="bi bi-signpost-2-fill"></i></button>
                            <a href="<?= base_url('telemetria/proceso/notificacion/'. $data->id) ?>" class="btn btn-info"><i class="bi bi-bell-fill"></i></a>
                            <a href="<?= base_url('telemetria/proceso/estacion/edit/'. $data->id) ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                            <button onclick="Eliminar(<?= $data->id ?>)" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>           
            <?php 
                    endforeach;
                endif;
            ?>
        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="AccionesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog-md">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registro de Acciones</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>            
        </div>
        </div>
    </div>
    </div>
    <script>

        function show(id) {
            $.ajax({
                url: "<?= base_url('telemetria/proceso/estacion/accion');?>/"+id,          
                type: "get",
                dataType: "html",
                //data: 
                success: function(data) { 
                    $("#modal-body").html(data);
                    let myModal = new bootstrap.Modal(document.getElementById('AccionesModal'),{})
                    myModal.show();
                }
            });
        }    

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
                        url: "<?= base_url('telemetria/proceso/estacion/delete');?>/"+id,          
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