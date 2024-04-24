<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?> 
<?= $this->section('content') ?>
    <h2>Nuevo Registro Documento</h2>
    <a href="<?= base_url('academico/solicitud/document/') . $solicitud->id;?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/archivo/save');?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $solicitud->id ?>" >
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger" style="margin: 5px;">
                <li><?= esc($error) ?></li>
            </div>    
        <?php endforeach ?>
        <div class="form-group">
            <label for="nombre">Tipo</label>           
            <select name="tipoD" class="form-control">
                <?php foreach ($todos as $data): ?>
                    <option value="<?= $data ->id ?>"> <?= $data->documento?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="periodo">Archivo a Cargar:</label>
            <input name="archivo" class="form-control" type="file" class="form-control">
        </div>        
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>