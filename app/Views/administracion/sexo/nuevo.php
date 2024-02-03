<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <nav class="nav">
        <a class="nav-link active" aria-current="page" href="<?= base_url();?>">Inicio</a>
        <a class="nav-link" href="<?= base_url('admin/sexo');?>">sexo</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
    </nav>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro Sexo</h2>
    <form action="<?= base_url('admin/sexo/guardar');?>" method="post">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
        </div>
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>