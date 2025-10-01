<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
  </br><h2 style="display: flex; justify-content: center">Bienvenido <?= $usuario->nombre ?></h2></br> 
      <?php if (is_object($vigente)): ?>
        <h2 style="display: flex; justify-content: center">Periodo Vigente: <?= $vigente->codigo . " - " . $vigente->anio ?></h2> 
      <?php else: ?>
        <h2 style="display: flex; justify-content: center">Periodo Vigente: Fecha NO contemplada en ciclo Vigente</h2> 
      <?php endif ?>
    <div class="row">
      <div class="col-md-6"> 
        <canvas id="chart-P" style="width:100%;max-width:600px"></canvas>        
      </div>
      <div class="col-md-6">     
        <canvas id="chart-E" style="width:100%;max-width:600px"></canvas>     
      </div>
    </div>
  
    
    <?php 
    $label='';
    $serie='';
    $color='';
    foreach($tabla1 as $data){
        $label=$label . '"' . $data->nombreProceso.'",';
        $serie=$serie . $data->cuenta.',';
        $color=$color . '"' . $data->color.'",';
    }  
    $label2='';
    $serie2='';
    foreach($tabla2 as $data){
        $label2=$label2 . '"' . $data->accion.'",';
        $serie2=$serie2 . $data->cuenta.',';        
    }  
    ?>

   
    <script src="<?= base_url('js/chart.js') ?>"></script>
    <script>
       

        new Chart("chart-P", {
          type: 'doughnut',
          data: {
            labels:[<?= $label ?>],           
            datasets: [{
              data: [<?= $serie ?>],
              backgroundColor:[<?= $color ?>]
          }],            
        },
        options: {
            legend: {
              display: true,
              position: 'bottom',
              labels: {
                  fontColor: 'blue'
              }
            },
            title: {
                display: true,
                fontSize: 22,
                text: 'Solicitudes por Proceso'
            }
          }     
      });

              
         new Chart("chart-E", {
          type: 'doughnut',
          data: {
           labels:[<?= $label2 ?>],           
          datasets: [{
              data: [<?= $serie2 ?>],
              backgroundColor:["#964CE0","#4CE07D","#47433D","#516157","#595161",
              "#7A6E5B","#E0A54C","#805FA1","#5FA175"]
          }],            
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: 'blue'
                }
            },
            title: {
                display: true,
                fontSize: 22,
                text: 'Solicitudes por Estado'
            }
          }     
      });

  </script>

<?= $this->endSection() ?>