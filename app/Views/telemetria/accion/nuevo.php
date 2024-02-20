<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro Accion</h2>
    <a href="<?= base_url('telemetria/accion');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('telemetria/accion/save');?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
        </div>
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>