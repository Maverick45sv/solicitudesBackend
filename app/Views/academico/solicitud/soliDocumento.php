<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?> 
<div class="row">
<!--------------->
<div style="display: flex; justify-content: center; height: 100vh; width: 100%;">
    <div class="col-md-6">
    </br>
        <div class="row">
            <div class="col">
                <a href="<?= base_url('academico/solicitud');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
            </div>
            <div class="col" style="text-align: right;">
            <a href="<?= base_url('academico/archivo/new') . "/" . $solicitud->id ;?>" class="btn btn-primary" ><i class="bi bi-plus-circle"></i> </a><br><br>
            </div>   
        </div>
        <div class="card mb-3">
            <div class="card-header text-white bg-info" style="text-align: center;">
                <b>DOCUMENTOS DE LA SOLICITUD ID:<?= $solicitud->id ?></b>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="tablaDatos">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Creado</th>
                        <th>Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($todos as $dato): ?>
                        <tr>                           
                            <td><?= $dato->id ?></td>   
                            <td><?= $dato->nombre ?></td>                        
                            <td><?= date('d-m-Y (h:i a)', strtotime($dato->creado)) ?></td>               
                            <td>
                               <img src="data:image/jpg;base64,<?= \base64_encode($dato->imagen) ?>" width="300px" >
                            </td>  
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>