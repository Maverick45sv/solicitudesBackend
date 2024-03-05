<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?> 
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Atributo</h2>
    <a href="<?= base_url('academico/atributo');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/atributo/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $atributo->id ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?= $atributo->nombre ?>">
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <input type="text" class="form-control" name="tipo" placeholder="Nombre" value="<?= $atributo->nombre ?>">
        </div>
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>