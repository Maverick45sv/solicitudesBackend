<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro Proceso</h2>
    <a href="<?= base_url('telemetria/proceso');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('telemetria/proceso/save');?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="codigo">Codigo</label>
            <input type="text" class="form-control" name="codigo" placeholder="Codigo">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" placeholder="Descripcion">
        </div>
        <div class="form-group">
            <label for="descripcion">Cupo Inscripcion</label><br>
            <input type="checkbox"  name="cupo" value="1"> Verificar
        </div>
        <div class="form-group">
            <label for="nombre">Color</label>
            <input type="color"  name="color" >
        </div>   
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>