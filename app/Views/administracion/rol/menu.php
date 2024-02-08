<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro Menu para Rol <?= $rol->nombre ?></h2>
    <a href="<?= base_url('admin/rol');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    
    <input type="hidden" name="id" id="id" value="<?= $rol->id ?>"> 
    <?php 
        $habilita=[];
        foreach($habilitados as $data){
            $habilita[]=$data['id'];
        }
    ?>        
    <table class='table table-bordered table-striped table-hover'>
        <thead>
            <tr>
                <td>Id</td>
                <td>Padre</td>
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Incluir</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                if($todos): 
                    foreach($todos as $data):
            ?>
                    <tr>
                        <td><?= $data->id ?></td>
                        <td><?= $data->padre ?></td>
                        <td><?= $data->nombre ?></td>
                        <td><?= $data->descripcion ?></td>
                        <td>        
                            <?php if(\in_array($data->id, $habilita)):  ?>
                                <input type="checkbox" onclick="Quitar(<?= $data->id ?>)" checked>
                            <?php else: ?>    
                                <input type="checkbox" onclick="Asignar(<?= $data->id ?>)" >
                            <?php endif ?>
                        </td>
                    </tr>           
            <?php 
                    endforeach;
                endif;
            ?>
        </tbody>
    </table>
    <br><br>
    <script>
        function Asignar(id){ 
            let idrol = $("#id").val();
            $.ajax({
                url: "<?= base_url('admin/rol/option/asign');?>/"+id+"/"+idrol,          
                type: "get",
                dataType: "json",
                //data: 
                success: function(data) { 
                    location.reload();
                }
            });
        }

        function Quitar(id){ 
            let idrol = $("#id").val();
            $.ajax({
                url: "<?= base_url('admin/rol/option/delete');?>/"+id+"/"+idrol,          
                type: "get",
                dataType: "json",
                //data: 
                success: function(data) { 
                    location.reload();
                }
            });
        }
    </script>   
<?= $this->endSection() ?>