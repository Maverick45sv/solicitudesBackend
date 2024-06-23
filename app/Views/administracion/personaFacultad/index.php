<?= $this->extend('plantilla_revision') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Registro Facultades de <?= $persona->nombre . " " . $persona->apellido ?> </h2>    
    <form action="<?= base_url('admin/persona/facultad/save');?>" method="post">
        <?= csrf_field() ?>   
        <input type="hidden"  name="id_persona" value="<?= $persona->id ?>">    
        <div class="form-group">
            <label for="codigo">Facultad</label>
            <select name="id_facultad" id="facultad" class="form-control">
                <?php foreach ($facultades as $data): ?>
                    <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                <?php endforeach; ?>    
            </select>
        </div>        
        <br><br>
        <input class="btn btn-success" type="submit" value="Agregar">
        <br><br>
    </form>
    
    <hr>
    <br><br>
    <table class='table table-bordered table-striped table-hover'>
        <thead>
            <tr>
                <td>Id</td>
                <td>Facultad</td>           
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                if($todos): 
                    foreach($todos as $data):
            ?>
                    <tr>
                        <td><?= $data->idpefac ?></td>
                        <td><?= $data->nombre ?></td>                       
                        <td>
                             <button onclick="Eliminar(<?= $data->idpefac ?>)" class="btn btn-danger"><i class="bi bi-trash"></i></button>
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
                        url: "<?= base_url('admin/persona/facultad/delete');?>/"+id,          
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