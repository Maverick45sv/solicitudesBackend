<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Proceso</h2>
    <a href="<?= base_url('telemetria/proceso');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('telemetria/proceso/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $proceso->id ?>">
        <?= csrf_field() ?>        
        <div class="form-group">
            <label for="codigo">Codigo</label>
            <input type="text" class="form-control" name="codigo" placeholder="Codigo" value="<?= $proceso->codigo ?>">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?= $proceso->nombre ?>">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" value="<?= $proceso->descripcion ?>">
        </div>
        <div class="form-group">
            <label for="descripcion">Cupo Inscripcion</label><br>
            <?php if ($proceso->verificar_cupo): ?>
                <input type="checkbox"  name="cupo" value="1" checked> Verificar
            <?php else: ?>
                <input type="checkbox"  name="cupo" value="1"> Verificar
            <?php endif; ?>        
        </div>
        <div class="form-group">
            <label for="nombre">Color</label>
            <input type="color"  name="color" value="<?= $proceso->color ?>">
        </div>   
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>