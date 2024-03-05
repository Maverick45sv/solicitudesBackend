<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Registro Documento de Proceso <?= $proceso->nombre ?></h2>
    <div class="row" >
        <div class="col text-right">
            <a href="<?= base_url('telemetria/proceso/tipodocumento/new/'.$proceso->id) ?>" class="btn btn-success "><i class="bi bi-cloud-plus"></i> Nuevo Registro</a>
        </div>
    </div>
    <br><br>
    <table class='table table-bordered table-striped table-hover'>
        <thead>
            <tr>
                <td>Id</td>               
                <td>Documento</td>
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
                        <td><?= $data->documento ?></td>                      
                        <td>
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
                        url: "<?= base_url('telemetria/proceso/tipodocumento/delete');?>/"+id,          
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