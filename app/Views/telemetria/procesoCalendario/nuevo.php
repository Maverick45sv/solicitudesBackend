
    <h2>Registro Evento de Proceso Academico</h2>
   
     <form action="<?= base_url('academico/calendario/save');?>" method="post">
        <?= csrf_field() ?>   
        <div class="form-group">
                <label for="codigo">Proceso</label>
                <select name="proceso" id="proceso" class="form-control">
                    <?php foreach ($proceso as $data): ?>
                        <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                    <?php endforeach; ?>    
                </select>
            </div>       
        <div class="form-group">
            <label for="nombre">Inicio</label>
            <input type="date" class="form-control" name="inicio" placeholder="Inicio" value="<?= $fecha ?>" >
        </div> 
        <div class="form-group">
            <label for="nombre">Fin</label>
            <input type="date" class="form-control" name="fin" placeholder="Fin" value="<?= $fecha ?>" >
        </div>            
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar Evento">
    </form>
