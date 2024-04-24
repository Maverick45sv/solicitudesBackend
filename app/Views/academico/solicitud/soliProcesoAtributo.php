<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?> 
<div class="row">
    <!-- -->
    <div style="display: flex; justify-content: center; height: 100vh; width: 100%;">
    <div class="col-md-6">
</br>
        <a href="<?= base_url('academico/solicitud');?>" class="btn btn-success" ><i class="bi bi-arrow-return-left"></i> Regresar</a><br><br>
        <div class="card mb-3">
            <div class="card-header text-white bg-info" style="text-align: center;">
                <b>ATRIBUTOS DEL ESTUDIANTE</b>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="tablaDatos">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($todos as $dato): ?>
                        <tr>
                            <td><strong>Nombre:</strong></td>
                            <td><?= $dato->nombre ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tipo:</strong></td>
                            <td><?= $dato->tipo ?></td>
                        </tr>
                        <tr>
                            <td><strong>Valor:</strong></td>
                            <td><?= $dato->valor ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>