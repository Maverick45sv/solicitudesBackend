<?= $this->extend('plantilla_revision') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Persona</h2>   
    <form action="<?= base_url('admin/persona/telefono/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $telefono->id ?>">
    <input type="hidden" name="persona" value="<?= $persona->id ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Telefono:</label>
            <input type="text" class="form-control" name="telefono" placeholder="Nombre" value="<?= $telefono->telefono ?>">
        </div>       
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select name="tipo" class="form-control">
                <?php foreach ($tipo as $data): ?>
                    <?php if ($data->id == $telefono->id_tipo): ?>
                        <option value="<?= $data->id ?>" selected><?= $data->nombre ?></option>
                    <?php else: ?>
                        <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                    <?php endif ?>
                <?php endforeach ?>    
            </select>
        </div>   
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>