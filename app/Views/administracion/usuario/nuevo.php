<?= $this->extend('plantilla_revision') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Usuario para  <?= $persona->nombre . " " . $persona->apellido ?></h2>
    
    <form action="<?= base_url('admin/persona/usuario/save');?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden"  name="persona" value="<?= $persona->id ?>">
        <div class="form-group">
            <label for="nombre">Nombre de Usuario:</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre de usuario">
        </div>  
        <div class="form-group">
            <label for="correo">Correo:</label>
            <select name="correo" class="form-control">
                <?php foreach ($correos as $data): ?>
                    <option value="<?= $data->id ?>"><?= $data->correo ?></option>
                <?php endforeach ?>    
            </select>
        </div>        
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>