<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?> 
    <?= $menu ?>
<?= $this->endSection() ?> 
<?= $this->section('content') ?>
    <h2>Editar Registro Tipo de Documento</h2>
    <a href="<?= base_url('academico/tipodocumento');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/tipodocumento/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $tipodocumento->id ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?= $tipodocumento->nombre ?>">
        </div>
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>