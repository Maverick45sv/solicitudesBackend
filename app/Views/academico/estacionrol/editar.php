<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Carrera</h2>
    <a href="<?= base_url('academico/estacionrol');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/estacionrol/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $todos->id ?>">
        <?= csrf_field() ?> 
        <div class="form-group">
            <label for="idEstacion">Estación:</label>
            <select name="idEstacion" class="form-control">
                <?php foreach ($estacion as $data): ?>
                    <option value="<?= $data->id ?>" <?php echo ($data->id == $todos ->id_estacion) ? 'selected' : ''; ?>>
                    <?= $data->nombre ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div><br>
        <div class="form-group">
            <label for="idRol">Rol:</label>
            <select name="idRol" class="form-control">
                <?php foreach ($rol as $data): ?>
                    <option value="<?= $data->id ?>" <?php echo ($data->id == $todos ->id_rol) ? 'selected' : ''; ?>>
                    <?= $data->nombre ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>