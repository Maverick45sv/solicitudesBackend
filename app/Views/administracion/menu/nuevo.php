<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Nuevo Registro Menu</h2>
    <a href="<?= base_url('admin/menu');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('admin/menu/save');?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="enlace">Enlace</label>
            <input type="text" class="form-control" name="enlace" placeholder="Enlace">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" placeholder="Descripcion">
        </div>
        <div class="form-group">
            <label for="padre">Padre:</label> 
            <select name="padre" class="form-control">
                <?php foreach ($padre as $data): ?>
                    <option value="<?= $data->id ?>"><?= $data->nombre ?> (<?= $data->descripcion ?>)</option>
                <?php endforeach ?>    
            </select>
        </div>  
        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
    </form>
<?= $this->endSection() ?>