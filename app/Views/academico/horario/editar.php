<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Horario Academica</h2>
    <a href="<?= base_url('academico/horario');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/horario/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $horario->id ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="inicio">Inicio</label>
            <input type="time" class="form-control" name="inicio" placeholder="Inicio" value="<?= $horario->inicio ?>">
        </div>
        <div class="form-group">
            <label for="fin">Fin</label>
            <input type="time" class="form-control" name="fin" placeholder="Inicio" value="<?= $horario->fin ?>">
        </div>       
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>