<?= $this->extend('plantilla_revision') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Datos principales <?= $persona->nombre ?> <?= $persona->apellido ?></h2>
    
    <div class="row">
        <div class="offset-md-10 col-md-2 text-rigth">
            <br><a href="<?= base_url('admin/persona');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
        </div> 
    </div>
    <div class="row" >               
        <form action="<?= base_url('admin/persona/update');?>" method="post">
        <input type="hidden" name="id" value="<?= $persona->id ?>">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?= $persona->nombre ?>">
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" name="apellido" placeholder="Apellido" value="<?= $persona->apellido ?>">
            </div>
            <div class="form-group">
                <label for="dui">Dui:</label>
                <input type="text" class="form-control" name="dui" placeholder="DUI" value="<?= $persona->dui ?>">
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select name="sexo" class="form-control">
                    <?php foreach ($sexo as $data): ?>
                        <?php if ($data->id == $persona->id_sexo): ?>
                            <option value="<?= $data->id ?>" selected><?= $data->nombre ?></option>
                        <?php else: ?>
                            <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                        <?php endif ?>
                    <?php endforeach ?>    
                </select>
            </div>
            <div class="form-group">
                <label for="genero">Genero:</label>
                <select name="genero" class="form-control">
                    <?php foreach ($genero as $data): ?>
                        <?php if ($data->id == $persona->id_genero): ?>
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
    </div>
    
<?= $this->endSection() ?>