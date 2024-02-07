<?= $this->extend('plantilla_revision') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Registro Correos de <?= $persona->nombre . " " . $persona->apellido ?></h2>
    
    <div class="row" >
        <div class="col text-right">
            <a href="<?= base_url('admin/persona/mail/new/' . $persona->id) ?>" class="btn btn-success "><i class="bi bi-cloud-plus"></i> Nuevo Registro</a>
        </div>
    </div>
    <br><br>
    <table class='table table-bordered table-striped table-hover'>
        <thead>
            <tr>
                <td>Id</td>
                <td>Correo</td>
                <td>Tipo</td>                
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
                        <td><?= $data->correo ?></td>
                        <td><?= $data->tipo ?></td>                        
                        <td>
                            <a href="<?= base_url('admin/persona/mail/edit/' . $data->id) ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
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
                        url: "<?= base_url('admin/persona/mail/delete');?>/"+id,          
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