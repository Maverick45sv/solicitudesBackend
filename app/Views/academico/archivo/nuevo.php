<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?> 
<?= $this->section('content') ?>
    <h2>Nuevo Registro Archivos</h2>
    <a href="<?= base_url('academico/archivo');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/archivo/save');?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="nombre">Peso</label>
            <input type="text" class="form-control" name="peso" placeholder="Peso">
        </div>
        <div class="form-group">
            <label for="tipo">URL</label>
            <input type="url" class="form-control" name="url" placeholder="URL">
        </div>
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>