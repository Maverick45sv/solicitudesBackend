<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Editar Registro Oferta Academica</h2>
    <a href="<?= base_url('academico/solicitud');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/solicitud/update');?>" method="post">
    <input type="hidden" name="id" value="<?= $solicitud->id ?>">
        <div class="form-group">    
            <label for="hora">Proceso:</label> 
            <input type="hidden" name="idproceso" value="<?= $solicitud->idProceso ?>">
            <input type="text" class="form-control" name="proceso" placeholder="nombreProceso" value="<?= $solicitud->nombreProceso?>" readonly>
        </div> 
        <div class="form-group">
            <label for="inscritos">Persona:</label>
            <input type="hidden" name="idpersona" value="<?= $solicitud->idPersona ?>">
            <input type="text" class="form-control" name="persona" placeholder="nombrePersona" value="<?= $solicitud->nombrePersona ?>" readonly>
        </div> 
        <div class="form-group"> 
            <label for="inscritos">Periodo:</label>
            <input type="hidden" name="idperiodo" value="<?= $solicitud->idPeriodo ?>">
            <input type="text" class="form-control" name="periodo" placeholder="periodoAnio" value="<?= $solicitud->periodoAnio ?>" readonly>
        </div> 
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select name="estado" class="form-control">
                <?php foreach ($estado as $data): ?>
                    <option value="<?= $data->id ?>" <?php echo ($data->id == $solicitud->idAccion) ? 'selected' : ''; ?>>
                    <?= $data->nombre?>
                    </option>
                <?php endforeach ?>

            </select>
        </div> 
        <br><br>
        <input class="btn btn-success" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>