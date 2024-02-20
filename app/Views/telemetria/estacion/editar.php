<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Estacion</h2>
    <a href="<?= base_url('telemetria/estacion');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('telemetria/estacion/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $estacion->id ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?= $estacion->nombre ?>">
        </div>
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>