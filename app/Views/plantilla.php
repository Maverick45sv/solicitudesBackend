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
    <!-- menu -->
    <?= $this->renderSection('menu') ?>
    <!-- <img src="<?= base_url('img/02.jpg');?>" alt=""> -->
    <div class="content">
      <div class="card">
        <div class="card-body">
          <?= $this->renderSection('content') ?>
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