<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Rol</h2>
    <a href="<?= base_url('admin/rol');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('admin/rol/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $rol->id ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?= $rol->nombre ?>">
        </div>
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>