<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro ProcesoEstacion</h2>
    <a href="<?= base_url('telemetria/proceso/estacion/' . $procesoEstacion->id);?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('telemetria/proceso/estacion/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $procesoEstacion->id ?>">
    <input type="hidden" name="id_proceso" value="<?= $procesoEstacion->id_proceso ?>">
        <?= csrf_field() ?>        
        <div class="form-group">
            <label for="codigo">Estacion</label>
            <select name="id_estacion" id="estacion" class="form-control">
                <?php foreach ($estacion as $data): ?>
                    <?php if ($data->id == $procesoEstacion->id_estacion): ?>
                        <option value="<?= $data->id ?>" selected><?= $data->nombre ?></option>
                    <?php else: ?>
                        <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                    <?php endif ?>        
                <?php endforeach; ?>    
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Ruta</label>
            <input type="number" class="form-control" name="ruta" placeholder="Ruta" min="1" value="<?= $procesoEstacion->ruta ?>">
        </div>    
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>