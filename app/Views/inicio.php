<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
      <h2>Bienvenido <?= $usuario->nombre ?></h2>  
      <h2>Periodo Vigente: <?= $vigente->codigo . " - " . $vigente->anio ?></h2> 
    <script src="<?= base_url('public/chartist.js/dist/chartist.min.js') ?>"></script>
    <link href="<?= base_url('public/chartist.js/dist/chartist.css') ?>" type="text/css" rel="stylesheet">
 
    <div class="row">
      <div class="col-md-6">
        <h3>Solicitudes por Proceso</h3>
        <hr>
        <div class="chart-P"></div>
      </div>
      <div class="col-md-6">
      <h3>Solicitudes por Estado</h3>
        <hr>
      <div class="chart-E"></div>
      </div>
    </div>
  
    
    <?php 
    $label='';
    $serie='';
    foreach($tabla1 as $data){
        $label=$label . '"' . $data->nombreProceso.'",';
        $serie=$serie . $data->cuenta.',';
    }  
    $label2='';
    $serie2='';
    foreach($tabla2 as $data){
        $label2=$label2 . '"' . $data->accion.'",';
        $serie2=$serie2 . $data->cuenta.',';
    }  
    ?>
    <script>

          let data = {
            
              labels: [<?= $label ?>],
              series: [<?= $serie ?>]
          };
         
          let options = {
              width: 300,
              height: 300
          };
          new Chartist.Pie('.chart-P', data, options);
    

          let data2 = {
            
            labels: [<?= $label2 ?>],
            series: [<?= $serie2 ?>]
        };        
        
        new Chartist.Pie('.chart-E', data2, options);
  </script>

<?= $this->endSection() ?>