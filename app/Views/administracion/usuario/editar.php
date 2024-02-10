<?= $this->extend('plantilla_revision') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Registro Usuario <?= $usuario->nombre ?></h2>  
    <div class="offset-md-9 col-md-3">
        <button class="btn btn-success" onclick="Resetear()"><i class="bi bi-key-fill"></i> Retablecer Contrasenia</button>
    </div>    
    <form action="<?= base_url('admin/persona/usuario/update');?>" method="post">
        <input type="hidden" name="id" value="<?= $usuario->id ?>">
        <input type="hidden" name="persona" value="<?= $persona->id ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre de usuario:</label>
            <input type="text" class="form-control" name="usuario" value="<?= $usuario->nombre ?>" disabled>
        </div>       
        <div class="form-group">
            <label for="correo">Correo:</label>
            <select name="correo" class="form-control" required>
                <?php foreach ($correos as $data): ?>
                    <?php if ($data->correo == $usuario->correo): ?>
                        <option value="<?= $data->id ?>" selected><?= $data->correo ?></option>
                    <?php else: ?>
                        <option value="<?= $data->id ?>"><?= $data->correo ?></option>
                    <?php endif ?>
                <?php endforeach ?>    
            </select>
        </div> 
        <div class="form-group">
            <label for="rol">Nuevo Rol:</label>
            <select name="rol" class="form-control">
                <option value="0">No asignar nuevo por el momento</option>               
                <?php foreach ($roles as $data):  ?>                                   
                    <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                <?php endforeach ?> 
            </select>
        </div>         
        <input type="checkbox" name="activo" value="A" <?php if ($usuario->activo): ?>checked <?php endif ?>> Activo
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar"><br><br>
    </form>
    <hr>
    <div class="row">
        <h4>Roles Asignados</h4>  
        <table>
            <thead>
                <th>#</th>
                <th>ROL</th>
                <th>creado</th>
                <th>Accion</th>
            </thead>
            <tbody>
            <?php 
                if($usuarioroles): 
                    foreach($usuarioroles as $data):
            ?>
                    <tr>
                        <td><?= $data->id ?></td>
                        <td><?= $data->nombre ?></td>
                        <td><?= $data->creado ?></td>                        
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
                        url: "<?= base_url('admin/persona/usuario/delete_rol');?>/"+id,          
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

        function Resetear(){
            $.ajax({
                url: "<?= base_url('admin/persona/usuario/resetear');?>/<?= $usuario->id ?>",          
                type: "get",
                dataType: "json",
                //data: 
                success: function(data) { 
                   // console.log(data);
                    location.reload();
                }
            });
        }
    </script>
       
<?= $this->endSection() ?>