<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro Persona</h2>
    <a href="<?= base_url('admin/persona');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <?php if (! empty($errors)): ?>
        <div class="alert alert-danger">
        <?php foreach ($errors as $field => $error): ?>
            <p><i class="bi-x-octagon-fill"></i> <?= esc($error) ?></p>
        <?php endforeach ?>
        </div>
    <?php endif ?>
    <form action="<?= base_url('admin/persona/save');?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" class="form-control" name="apellido" placeholder="Apellido">
        </div>
        <div class="form-group">
            <label for="dui">Dui:</label>
            <input type="text" class="form-control" name="dui" placeholder="DUI">
        </div>
        <div class="form-group">
            <label for="sexo">Sexo:</label>
            <select name="sexo" class="form-control">
                <?php foreach ($sexo as $data): ?>
                    <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                <?php endforeach ?>    
            </select>
        </div>
        <div class="form-group">
            <label for="genero">Genero:</label>
            <select name="genero" class="form-control">
                <?php foreach ($genero as $data): ?>
                    <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                <?php endforeach ?>    
            </select>
        </div>
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>