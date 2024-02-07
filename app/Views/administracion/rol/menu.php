<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro Menu para Rol <?= $rol->nombre ?></h2>
    <a href="<?= base_url('admin/rol');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    
    <input type="hidden" name="id" value="<?= $rol->id ?>">    
        <?= $todos;?>
    <br><br>
       
   
<?= $this->endSection() ?>