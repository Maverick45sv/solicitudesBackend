<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de solicitudes</title>

    <!-- incluir CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('bootstrap/css/bootstrap.min.css');?>" >
    <link rel="stylesheet" type="text/css" href="<?= base_url('datatable/datatables.min.css');?>" >
    <link rel="stylesheet" type="text/css" href="<?= base_url('bootstrap/icons-1.11/font/bootstrap-icons.min.css');?>" >
    <link rel="stylesheet" type="text/css" href="<?= base_url('sweetalert/sweet.css');?>" >
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <!-- menu -->
            <?= $this->renderSection('menu') ?> 
        </div>
        <div class="row">
            <div class="col-md-1">
                <div class="col-sm-auto bg-light sticky-top">
                    <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top">
                        <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/persona/edit/' . $persona->id) ?>" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="editar">
                                    <i class="bi-person-gear fs-1"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/persona/mail/' . $persona->id) ?>" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="correo">
                                    <i class="bi-envelope-at fs-1"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/persona/telefono/' . $persona->id) ?>" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="telefono">
                                    <i class="bi-telephone fs-1"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/persona/facultad/'  . $persona->id) ?>" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="facultad">
                                    <i class="bi-building fs-1"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/persona/usuario/' . $persona->id) ?>" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="roles">
                                    <i class="bi-people fs-1"></i>
                                </a>
                            </li>
                           <!-- <li>
                                <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="usuario">
                                    <i class="bi-people fs-1"></i>
                                </a>
                            </li>-->
                        </ul>                    
                    </div>
                </div>
            </div>
            <div class="col-md-11">
                <div class="col-sm p-3 min-vh-100">
                    <!-- content -->
                    <div class="row">
                        <?= $this->renderSection('content') ?>
                    </div>                
                </div>
            </div>  
        </div>
    </div>    
</body>
<script src="<?= base_url('js/jquery3_7_1.js')?>"></script>
<script src="<?= base_url('bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('datatable/datatables.min.js')?>"></script>
<script src="<?= base_url('js/table.js')?>"></script>
<script src="<?= base_url('sweetalert/sweet.js')?>"></script>
</html>