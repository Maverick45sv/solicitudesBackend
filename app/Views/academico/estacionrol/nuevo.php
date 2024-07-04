<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro Estación - Rol</h2>
    <a href="<?= base_url('academico/estacionrol');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/estacionrol/save');?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="idEstacion">Estación:</label>
            <select name="idEstacion" class="form-control">
                <?php foreach ($datosEstacion as $data): ?>
                    <option value="<?= $data ->id ?>"> <?= $data->nombre?></option>
                <?php endforeach ?>
            </select>
        </div><br>

        <div class="form-group">
            <label for="idRol">Rol :</label>
            <select name="idRol" class="form-control">
                <?php foreach ($datosRol as $data): ?>
                    <option value="<?= $data ->id ?>"> <?= $data->nombre?></option>
                <?php endforeach ?>
            </select>
        </div> 

        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>