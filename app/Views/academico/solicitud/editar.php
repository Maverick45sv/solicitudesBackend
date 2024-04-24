<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?> 
<div class="row">
    <div class="col-md-6">
        <a href="<?= base_url('academico/solicitud');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
            <div class="card  mb-3">
                <div class="card-header text-white bg-info">
                    Datos de la Solicitud
                </div>
                <div class="card-body">
                    <p>Proceso: <?= $solicitud->nombreProceso?><br>
                    Persona: <?= $solicitud->nombrePersona ?><br>
                    Periodo: <?= $solicitud->periodoAnio ?><br>
                    Fecha Creado: <?= date('d-m-Y (h:i a)', strtotime($solicitud->fecha)) ?><br>
                    Estado Actual:  <b><?= $bitacoraA->accion ?></b><br>
                    Estacion Actual:  <b><?= $bitacoraA->estacion ?></b><br>
                    </p>
                </div>
            </div>   
    </div>
    <div class="col-md-6"> 
        <h4>Agregar Bitacora</h4>   
        <form action="<?= base_url('academico/solicitud/update');?>" method="post">
        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
        <input type="hidden" id="id" name="id" value="<?= $solicitud->id ?>">
            <div class="form-group">
                <label for="idestados">Nuevo Estado:</label>
                <select id= "idestados" name="idestados" class="form-select">
                    <?php foreach ($estado as $data): ?>
                        <option value="<?= $data->id ?>" ><?= $data->nombre?></option>
                    <?php endforeach ?>
                </select>
            </div>  
            <div class="form-group">
                <label for="idestados">Comentario:</label>
                <textarea name="comentario" class="form-control" cols="20" rows="5"></textarea>
               
            </div>       
            <br><br>
            <input class="btn btn-success" id="Agregarr" type="submit" value="Agregar">
        </form>
    </div>   
</div> 
<hr>
<div class="row">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Creado</th>
                <th>Accion</th>
                <th>Usuario</th>
                <th>Comentario</th>
                <th>Activa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bitacora as $data): ?>
            <tr <?php if ($data->activa){ echo 'class="bg-info"'; }; ?> >
                <td><?= $data->id ?></td>
                <td><?= date('d-m-Y (h:i a)', strtotime($data->creado)) ?></td>
                <td><?= $data->accion ?></td>
                <td><?= $data->usuario ?></td>
                <td><?= $data->comentario ?></td>
                <td><?= $data->activa ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>               
    </table>
</div>
<?= $this->endSection() ?>

