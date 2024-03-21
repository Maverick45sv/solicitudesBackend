    <h2>Nuevos Datos de Inscripciones</h2>
    <div class="row">
        <form action="<?= base_url('academico/oferta/process');?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="periodo">Ciclo a Cargar:</label>
                <select name="periodo" class="form-control">
                    <?php foreach ($periodo as $data): ?>
                        <option value="<?= $data ->id ?>"> <?= $data ->codigo?> - <?= $data ->anio?></option>
                    <?php endforeach ?>
                </select>
            </div> 
            <br> 
            <div class="form-group">
                <label for="periodo">Archivo a Cargar:</label>
                <input name="archivo" type="file" class="form-control">
                <br><br>
            <input class="btn btn-success" type="submit" value="Procesar">
        </form>
    </div>  


