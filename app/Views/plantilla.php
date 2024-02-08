<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de solicitudes</title>

    <!-- incluir CSS -->
    <!-- Bootstrap -->  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/datatable/datatables.min.css');?>" >
    <!-- iconos -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/bootstrap/icons-1.11/font/bootstrap-icons.min.css');?>" >
    <!-- sweetalert -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/sweetalert/sweet.css');?>" >
    <!-- menu CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/css/default.css');?>" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/css/component.css');?>" />
	<script src="<?= base_url('public/js/modernizr.custom.js')?>"></script>
</head>
<body>
    <div class="container demo-3">	
    <!-- menu -->
    <div class="row">
        <div class="col-md-3">
            <div id="dl-menu" class="dl-menuwrapper">
                <button class="dl-trigger">Menu Principal</button>
                <ul class="dl-menu">
                    <?= $this->renderSection('menu') ?>
                </ul>
            </div><!-- /dl-menuwrapper -->
        </div>
        <div class="col-md-9">
            <!-- content -->
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>
</body>
<script src="<?= base_url('public/js/jquery3_7_1.js')?>"></script>
<script src="<?= base_url('public/bootstrap/js/bootstrap4.js')?>"></script>
<script src="<?= base_url('public/datatable/datatables.min.js')?>"></script>
<script src="<?= base_url('public/js/table.js')?>"></script>
<script src="<?= base_url('public/sweetalert/sweet.js')?>"></script>
<!-- menu CSS -->
<script src="<?= base_url('public/js/jquery.dlmenu.js')?>"></script>
<script>
    $(function() {
        $( '#dl-menu' ).dlmenu({
					animationClasses : { classin : 'dl-animate-in-5', classout : 'dl-animate-out-5' }
		});
    });
</script>
</html>