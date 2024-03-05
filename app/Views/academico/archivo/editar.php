<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?> 
    <?= $menu ?>
<?= $this->endSection() ?> 
<?= $this->section('content') ?>
    <h2>Editar Registro Archivo</h2>
    <a href="<?= base_url('academico/archivo');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/archivo/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $archivo->id ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?= $archivo->nombre ?>">
        </div>
        <div class="form-group">
            <label for="tipo">Peso</label>
            <input type="text" class="form-control" name="peso" placeholder="peso" value="<?= $archivo->peso ?>">
        </div>
        <div class="form-group">
            <label for="tipo">URL</label>
            <input type="text" class="form-control" name="url" placeholder="url" value="<?= $archivo->url ?>">
        </div>
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>