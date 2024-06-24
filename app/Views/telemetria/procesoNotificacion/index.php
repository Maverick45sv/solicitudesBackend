<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Registro Notificacion en Estacion de Proceso <?= $proceso->nombre ?> Ruta <?= $procesoE->ruta ?> </h2>
    <a href="<?= base_url('telemetria/proceso/estacion') . "/" . $proceso->id;?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('telemetria/proceso/notificacion/save');?>" method="post">
        <?= csrf_field() ?>   
        <input type="hidden"  name="id_proceso_estacion" value="<?= $procesoE->id ?>">    
        <div class="form-group">
            <label for="codigo">Rol:</label>
            <select name="id_rol" id="rol" class="form-control">
                <?php foreach ($roles as $data): ?>
                    <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                <?php endforeach; ?>    
            </select>
        </div>        
        <br><br>
        <input class="btn btn-success" type="submit" value="Agregar">
        <br><br>
    </form>
    <br><br>
    <table class='table table-bordered table-striped table-hover'>
        <thead>
            <tr>
                <td>Id</td>               
                <td>Rol</td>               
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
                        <td><?= $data->rol ?></td>                      
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
                        url: "<?= base_url('telemetria/proceso/notificacion/delete');?>/"+id,          
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