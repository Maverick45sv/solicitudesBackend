<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Oferta Academica</h2>
    <a href="<?= base_url('academico/oferta');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/oferta/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $oferta->id ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="periodo">Ciclo:</label>
            <select name="periodo" class="form-control">
                <?php foreach ($periodo as $data): ?>
                    <?php if ($data->id == $oferta->id_periodo): ?>
                        <option value="<?= $data ->id?>" selected><?= $data ->codigo?> - <?= $data ->anio?></option>
                    <?php else: ?>
                        <option value="<?= $data->id ?>"><?= $data ->codigo?> - <?= $data ->anio?></option>
                    <?php endif ?>
                <?php endforeach ?>               
            </select>
        </div> 
        <div class="form-group">
            <label for="asignatura">Asignatura:</label>
            <select name="asignatura" class="form-control">
                <?php foreach ($asignatura as $data): ?>
                    <?php if ($data->id == $oferta->id_asignatura): ?>
                        <option value="<?= $data ->id?>" selected><?= $data->nombre ?></option>
                    <?php else: ?>
                        <option value="<?= $data->id ?>"><?= $data->nombre ?></option>
                    <?php endif ?>
                <?php endforeach ?>               
            </select>
        </div> 
        <div class="form-group">
            <label for="aula">Aula</label>
            <input type="text" class="form-control" name="aula" placeholder="Aula" value="<?= $oferta->aula ?>">
        </div>
        <div class="form-group">
            <label for="seccion">Seccion</label>
            <input type="text" class="form-control" name="seccion" placeholder="Seccion" value="<?= $oferta->seccion ?>">
        </div>
        <div class="form-group">
            <label for="dia">Dia:</label>
            <select name="dia" class="form-control">
                <option value="L"> Lunes</option>
                <option value="M"> Martes</option>
                <option value="Mi"> Miercoles</option>
                <option value="J"> Jueves</option>
                <option value="V"> Viernes</option>
                <option value="S"> Sabado</option>
                <option value="D"> Domingo</option>    
            </select>
        </div> 
        <div class="form-group">
            <label for="hora">Hora:</label>
            <select name="hora" class="form-control">                
                <?php foreach ($horas as $data): ?>
                    <option value="<?php echo $data->inicio ?> - <?php echo $data->fin ?>"> <?php echo $data->inicio ?> - <?php echo $data->fin ?></option>
                <?php endforeach ?>
            </select>
        </div> 
        <div class="form-group">
            <label for="inscritos">Inscritos</label>
            <input type="text" class="form-control" name="inscritos" placeholder="Inscritos" value="<?= $oferta->inscritos ?>">
        </div>        
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>