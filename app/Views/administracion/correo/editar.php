<?= $this->extend('plantilla_revision') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Persona</h2>   
    <form action="<?= base_url('admin/persona/mail/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $correo->id ?>">
    <input type="hidden" name="persona" value="<?= $persona->id ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Correo:</label>
            <input type="text" class="form-control" name="correo" placeholder="Nombre" value="<?= $correo->correo ?>">
        </div>       
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select name="tipo" class="form-control">
                <?php foreach ($tipo as $data): ?>
                    <?php if ($data->id == $correo->id_tipo): ?>
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