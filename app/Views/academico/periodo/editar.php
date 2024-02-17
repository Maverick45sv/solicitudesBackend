<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Asignatura</h2>
    <a href="<?= base_url('academico/periodo');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/periodo/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $periodo->id ?>">
        <?= csrf_field() ?>        
        <div class="form-group">
            <label for="nombre">Codigo</label>
            <input type="text" class="form-control" name="codigo" placeholder="Codigo" value="<?= $periodo->codigo ?>">
        </div>
        <div class="form-group">
            <label for="nombre">Anio</label>
            <input type="numbre" class="form-control" name="anio" placeholder="Anio" min=2000 max=3000 value="<?= $periodo->anio ?>">
        </div>
        <div class="form-group">
            <label for="nombre">Inicio</label>
            <input type="date" class="form-control" name="inicio" placeholder="Inicio" value="<?= $periodo->inicio ?>">
        </div>
        <div class="form-group">
            <label for="nombre">Fin</label>
            <input type="date" class="form-control" name="fin" placeholder="Fin" value="<?= $periodo->fin ?>">
        </div>    
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>