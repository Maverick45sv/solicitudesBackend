<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?> 
    <h2>Editar Registro Oferta Academica</h2>
    <a href="<?= base_url('academico/solicitud');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
    <form action="<?= base_url('academico/solicitud/update');?>" method="post">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <input type="hidden" id="id" name="id" value="<?= $solicitud->id ?>">
        <div class="form-group">    
            <label for="proceso">Proceso:</label> 
            <input type="hidden" id="idproceso" name="idproceso" value="<?= $solicitud->idProceso ?>">
            <input type="text" class="form-control" name="proceso" placeholder="nombreProceso" value="<?= $solicitud->nombreProceso?>" readonly>
        </div> 
        <div class="form-group">
            <label for="persona">Persona:</label>
            <input type="hidden" id="idpersona"name="idpersona" value="<?= $solicitud->idPersona ?>">
            <input type="text" class="form-control" name="persona" placeholder="nombrePersona" value="<?= $solicitud->nombrePersona ?>" readonly>
        </div> 
        <div class="form-group"> 
            <label for="periodo">Periodo:</label>
            <input type="hidden" id="idperiodo" name="idperiodo" value="<?= $solicitud->idPeriodo ?>">
            <input type="text" class="form-control" name="periodo" placeholder="periodoAnio" value="<?= $solicitud->periodoAnio ?>" readonly>
        </div> 
        <div class="form-group"> 
            <label for="Nfecha">Fecha:</label>
            <input type="text" class="form-control" id="Nfecha" name="Nfecha" placeholder="nfecha" value="<?= date('d-m-Y (h:i a)', strtotime($solicitud->fecha)) ?>" readonly>
        </div> 
        <div class="form-group">
            <label for="idestados">Estado:</label>
            <select id= "idestados" name="idestados" class="form-control">
                <?php foreach ($estado as $data): ?>
                    <option value="<?= $data->id ?>" <?php echo ($data->id == $solicitud->idAccion) ? 'selected' : ''; ?>>
                    <?= $data->nombre?>
                    </option>
                <?php endforeach ?>
            </select>
        </div> 
        <br><br>
        <input class="btn btn-success" id="Modificar" type="submit" value="Modificar">
    </form>
<?= $this->endSection() ?>

