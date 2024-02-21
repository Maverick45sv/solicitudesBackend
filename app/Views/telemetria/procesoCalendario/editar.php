
<h2>Registro Evento de Proceso Academico</h2>
   <form action="<?= base_url('academico/calendario/update');?>" method="post">
        <input type="hidden" name="id" value="<?= $procesoCalendario->id ?>">
        <?= csrf_field() ?>   
        <div class="form-group">
              <label for="codigo">Proceso</label>
              <select name="proceso" id="proceso" class="form-control">
                  <?php foreach ($proceso as $data): ?>
                    <?php if ($data->id == $procesoCalendario->id_proceso): ?>
                        <option value="<?= $data->id ?>" selected><?= $data->nombre ?></option>
                    <?php else: ?>
                        <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                    <?php endif ?>        
                      
                  <?php endforeach; ?>    
              </select>
          </div>       
        <div class="form-group">
            <label for="nombre">Inicio</label>
            <input type="date" class="form-control" name="inicio" placeholder="Inicio" value="<?= $procesoCalendario->inicio ?>" >
        </div> 
        <div class="form-group">
            <label for="nombre">Fin</label>
            <input type="date" class="form-control" name="fin" placeholder="Fin" value="<?= $procesoCalendario->fin ?>" >
        </div>            
        <br><br>
        <div class="row">
            <div class="col-md-6">
                <input class="btn btn-success" type="submit" value="Modificar Evento">
            </div>
            <div class="col-md-6 text-end">
                <button onclick="Eliminar(<?= $procesoCalendario->id ?>)" class="btn btn-danger"><i class="bi bi-trash"></i></button>
            </div>
        </div>                
    </form>

    <script>   
             
             function Eliminar(id){                
                $.ajax({
                    url: "<?= base_url('academico/calendario/delete');?>/"+id,          
                    type: "get",
                    dataType: "json",
                    //data: 
                    success: function(data) { 
                        location.reload();
                    }
                });                   
             }
         </script>
