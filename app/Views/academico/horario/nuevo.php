<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro Horario Academica</h2>
    <a href="<?= base_url('academico/horario');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/horario/save');?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="inicio">Inicio</label>
            <input type="time" class="form-control" name="inicio" placeholder="Inicio">
        </div>
        <div class="form-group">
            <label for="fin">Fin</label>
            <input type="time" class="form-control" name="fin" placeholder="Inicio">
        </div>
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>