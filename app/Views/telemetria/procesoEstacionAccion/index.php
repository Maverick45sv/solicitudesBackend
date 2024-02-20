
    <h2>Proceso <?= $proceso->nombre ?></h2>
    <div class="row">
        <div class="offset-md-11">
            <button class="btn btn-primary" onclick="cambio()"><i class="bi bi-plus-circle"></i></button>
        </div>
    </div>  
    <div class="row" id="contenedor" style="display:none">  
        <form action="<?= base_url('telemetria/procesoEstacionAccion/save');?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id_origen" value="<?= $proceso_estacion->id ?>">
            <input type="hidden" name="id_proceso" value="<?= $proceso->id ?>">
            <div class="form-group">
                <label for="codigo">Estacion Destino</label>
                <select name="id_destino" id="destino" class="form-control">
                    <?php foreach ($estaciones as $data): ?>
                        <option value="<?= $data->id ?>"><?= $data->estacion ?></option>
                    <?php endforeach; ?>    
                </select>
            </div>
            <div class="form-group">
                <label for="codigo">Accion</label>
                <select name="id_accion" id="accion" class="form-control">
                    <?php foreach ($acciones as $data): ?>
                        <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                    <?php endforeach; ?>    
                </select>
            </div>
            <div class="form-group">           
                <input type="checkbox" name="notificacion" value="1" > Con Notificacion <br>
                <input type="checkbox" name="interno" value="1" > Movimiento Interno
            </div>       
            <br><br>
            <input class="btn btn-success" type="submit" value="Guardar">
        </form>
    </div>
    <hr>
    <br>
    <table class='table table-bordered table-striped table-hover'>
        <thead>
            <tr>
                <td>Id</td>               
                <td>Accion</td>
                <td>Destino</td>
                <td>Notificacion</td>
                <td>Movimiento Interno</td>
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
                        <td><?= $data->accion ?></td>
                        <td><?= $data->destino ?></td>
                        <td>
                            <?php if ($data->notificacion): ?>
                                SI
                            <?php else: ?>    
                                NO
                            <?php endif ?>     
                        </td> 
                        <td>
                            <?php if ($data->interno): ?>
                                SI
                            <?php else: ?>    
                                NO
                            <?php endif ?>     
                        </td>                      
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
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>
    <script>

        function cambio(){
            if($("#contenedor").is(':visible')){
                $("#contenedor").hide();
            }else{
                $("#contenedor").show();
            }
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
                        url: "<?= base_url('telemetria/procesoEstacionAccion/delete');?>/"+id,          
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
