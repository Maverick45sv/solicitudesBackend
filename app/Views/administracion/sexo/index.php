<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <nav class="nav">
        <a class="nav-link active" aria-current="page" href="<?= base_url();?>">Inicio</a>
        <a class="nav-link" href="<?= base_url('admin/sexo');?>">sexo</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
    </nav>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Registro Sexo</h2>
    <div class="row" >
        <div class="col text-right">
            <a href="sexo/new" class="btn btn-success "><i class="bi bi-cloud-plus"></i> Nuevo Registro</a>
        </div>
    </div>
    <br><br>
    <table class='table table-bordered table-striped table-hover'>
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                if($todos): 
                    foreach($todos as $data):
            ?>
                    <tr>
                        <td><?= $data->id ?></td>
                        <td><?= $data->nombre ?></td>
                        <td>
                            <a href="sexo/edit/<?= $data->id ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                            <a href="sexo/delete/<?= $data->id ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>           
            <?php 
                    endforeach;
                endif;
            ?>
        </tbody>
    </table>
<?= $this->endSection() ?>