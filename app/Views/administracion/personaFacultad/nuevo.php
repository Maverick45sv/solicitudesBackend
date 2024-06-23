<?= $this->extend('plantilla_revision') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro de correo para <?= $persona->nombre . " " . $persona->apellido ?></h2>
    
    <form action="<?= base_url('admin/persona/mail/save');?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden"  name="persona" value="<?= $persona->id ?>">
        <div class="form-group">
            <label for="nombre">Correo:</label>
            <input type="email" class="form-control" name="correo" placeholder="Correo">
        </div>       
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select name="tipo" class="form-control">
                <?php foreach ($tipo as $data): ?>
                    <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                <?php endforeach ?>    
            </select>
        </div>        
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>