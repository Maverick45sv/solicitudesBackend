<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menup ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Menu</h2>
    <a href="<?= base_url('admin/menu');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('admin/menu/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $menu->id ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?= $menu->nombre ?>">
        </div>
        <div class="form-group">
            <label for="enlace">Enlace</label>
            <input type="text" class="form-control" name="enlace" placeholder="Enlace" value="<?= $menu->enlace ?>">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" value="<?= $menu->descripcion ?>">
        </div>
        <div class="form-group">
            <label for="padre">Padre:</label>
            <select name="padre" class="form-control">
                <?php foreach ($padre as $data): ?>
                    <?php if ($data->id == $menu->padre): ?>
                        <option value="<?= $data->id ?>" selected><?= $data->nombre ?> (<?= $data->descripcion ?>)</option>
                    <?php else: ?>
                        <option value="<?= $data->id ?>"><?= $data->nombre ?> (<?= $data->descripcion ?>)</option>
                    <?php endif ?>
                <?php endforeach ?>     
            </select>
        </div>  
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>