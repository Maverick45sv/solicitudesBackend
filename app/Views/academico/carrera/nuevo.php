<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro Carrera</h2>
    <a href="<?= base_url('academico/carrera');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/carrera/save');?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" class="form-control" name="codigo" placeholder="Codigo">
        </div>

        <div class="form-group">
            <label for="facultad">Facultad:</label>
            <select name="opcionFacultad" class="form-control">
                <?php foreach ($datosf as $data): ?>
                    <option value="<?= $data['idp'] ?>"> <?= $data['facultadp']?></option>
                <?php endforeach ?>
            </select>
        </div> 

        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>