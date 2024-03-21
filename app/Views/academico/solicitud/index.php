<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h2>Registro de Solicitudes</h2></br>
    <div class="row" ></br>
        <div class="form-group" style = "display:flex" style="justify-content:center" style="width:100%">
        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="col text-right" style = "width:25%">
                <label for="periodo"  style = "margin:10px">Periodo:</label><br>
                <select id="periodo" name="periodo" class="form-select" style = "width:80%"> 
                    <option value="">---</option> 
                    <?php foreach ($todosPeriodo as $data): ?>
                        <option value="<?= $data ->id ?>"> <?= $data ->anio?></option>
                    <?php endforeach ?> 
                </select>
            </div>

            <div class="col text-right" style = "width:25%">
                <label for="proceso"  style = "margin:10px">Procesos:</label><br>
                <select id="proceso" name="proceso" class="form-select" style = "width:80%"> 
                    <option value="">---</option> 
                    <?php foreach ($todosProceso as $data): ?>
                        <option value="<?= $data ->id ?>"> <?= $data ->nombre?></option>
                    <?php endforeach ?>   
                </select>
            </div>

            <div class="col text-right" style = "width:25%">
                <label for="proceso"  style = "margin:10px" >Estado:</label><br>
                <select id="accion" name="proceso" class="form-select" style = "width:80%"> 
                    <option value="">---</option> 
                    <?php foreach ($todosAccion as $data): ?>
                        <option value="<?= $data ->id ?>"> <?= $data -> nombre?></option>
                    <?php endforeach ?> 
                </select>
            </div>
            <div class="col text-right" style="width:25%" >
            <button  class="btn btn-success  " id="btnMostrarTodos" style = "margin-top:43px" style = "margin-right:10px"> Mostrar Todos</button>
        </div>
        </div>


    </div>
    <br><br>
    <table class='table table-bordered table-striped table-hover' id= "tablaDatos" name= "tablaDatos">
        <thead>
            <tr>
                <td>Id</td>
                <td>Proceso</td>
                <td>Persona</td>
                <td>Periodo</td>
                <td>Fecha y Hora</td>
                <td>Estado</td>
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
                        <td><?= $data->nombreProceso ?></td>
                        <td><?= $data->nombrePersona ?></td>
                        <td><?= $data->periodoAnio ?></td>
                        <td><?= date('d-m-Y (h:i a)', strtotime($data-> fecha))?></td>
                        <td><?= $data->nombreAccion ?></td>
                        <td>
                            <a href="solicitud/edit/<?= $data->id ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                            <button onclick="Eliminar(<?= $data->id ?>)" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>           
            <?php 
                    endforeach;
                endif;
            ?> 
        </tbody>
    </table>

    <!-- Enviar filtro de los datos -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function()
        {
            $('#proceso, #periodo, #accion').on('change', function()
            {
                var proceso = $('#proceso').val();
                var periodo = $('#periodo').val();
                var accion = $('#accion').val();

                $.ajax(
                {
                    url: "<?= base_url('academico/solicitud/filter');?>",
                    type: 'GET',
                    data: {
                        proceso: proceso,
                        periodo: periodo,
                        accion: accion
                    },
                    dataType: 'json',
                    success: function(response) 
                    {
                        actualizarTabla(response.filtro);
                    },
                    error: function(xhr, status, error) 
                    {
                        console.error('Error en la solicitud AJAX:', error);
                    }

                });
            })
            // Evento que se activa cuando se hace clic en el botón de mostrar todos
             $('#btnMostrarTodos').click(function() {

            $.ajax({
            url: "<?= base_url('academico/solicitud/data');?>",
            type: 'GET',
            success: function(response) {
                actualizarTabla(response.todos);
                $('#proceso').val('');
                $('#periodo').val('');
                $('#accion').val('');
            },
            error: function(xhr, status, error) 
            {
                console.error('Error en la solicitud AJAX:', error);
            }
        });
    });
        }) 

    function formatearFecha(fecha) {
    var fechaObj = new Date(fecha);
    var dia = fechaObj.getDate();
    var mes = fechaObj.getMonth() + 1;
    var año = fechaObj.getFullYear();
    var horas = fechaObj.getHours();
    var minutos = fechaObj.getMinutes();
    var am_pm = horas >= 12 ? 'PM' : 'AM';
    horas = horas % 12;
    horas = horas ? horas : 12; // El reloj en el formato 12 horas
    minutos = minutos < 10 ? '0' + minutos : minutos;
    var horaFormateada = horas + ':' + minutos + ' ' + am_pm;
    return dia + '-' + mes + '-' + año + ' (' + horaFormateada + ')';
}

    // Función para actualizar la tabla con los datos filtrados y todos los datos
        function actualizarTabla(datos) {
        // Limpiar la tabla
        $('#tablaDatos tbody').empty();
        
        // Llenar la tabla con los datos filtrados
        $.each(datos, function(index, fila){
            var filaHtml = '<tr>';
            // Construir cada celda de la fila con los datos recibidos
            filaHtml += '<td>' + fila.id + '</td>';
            filaHtml += '<td>' + fila.nombreProceso + '</td>';
            filaHtml += '<td>' + fila.nombrePersona + '</td>';
            filaHtml += '<td>' + fila.periodoAnio + '</td>';
            filaHtml += '<td>' + formatearFecha(fila.fecha) + '</td>';
            filaHtml += '<td>' + fila.nombreAccion + '</td>';
            filaHtml += '<td>';
            filaHtml += '<a href="solicitud/edit/' + fila.id + ' " class="btn btn-primary" style = "margin:2px"><i class="bi bi-pencil-square"></i></a>';
            filaHtml += '<button onclick="Eliminar(' + fila.id + ')" class="btn btn-danger" style = "margin:2px"> <i class="bi bi-trash"></i></button>';
            filaHtml += '</td>';
            // Agregar más celdas si es necesario
            filaHtml += '</tr>';
            
            // Agregar la fila a la tabla
            $('#tablaDatos tbody').append(filaHtml);
        });
    }
        //-- ----------------------------------------------- -->
        function Eliminar(id){
            Swal.fire({
                title: "Esta seguro de Eliminar este registro?",
                text: "La eliminacion es permanente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirmar",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('academico/oferta/delete');?>/"+id,          
                        type: "get",
                        dataType: "json",
                        //data: 
                        success: function(data) { 
                            location.reload();
                        }
                    });
                }
            });
        }
    </script>
<?= $this->endSection() ?>