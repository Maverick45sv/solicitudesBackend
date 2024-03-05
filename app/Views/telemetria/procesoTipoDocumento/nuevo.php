<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro Documento para proceso <?= $proceso->nombre ?></h2>
    <?php if (! empty($errors)): ?>
        <div class="alert alert-danger">
        <?php foreach ($errors as $field => $error): ?>
            <p><i class="bi-x-octagon-fill"></i> <?= esc($error) ?></p>
        <?php endforeach ?>
        </div>
    <?php endif ?>
    <a href="<?= base_url('telemetria/proceso/tipodocumento/'.$proceso->id) ?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('telemetria/proceso/tipodocumento/save');?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id_proceso" value="<?= $proceso->id ?>">
        <div class="form-group">
            <label for="codigo">Atributo</label>
            <select name="id_tipoDocumento" id="tipoDocumento" class="form-control">
                <?php foreach ($tipoDocumento as $data): ?>
                    <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                <?php endforeach; ?>    
            </select>
        </div>        
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>