$(document).ready(function () {

    let calendarEl = document.getElementById('calendar');
            
    $modal = $('#CalendarModal');    
    $modal.appendTo("body");
    
    $('#calendar').css('max-width', '950px').css('margin', '40px auto');
    let calendar = new FullCalendar.Calendar(calendarEl, { 
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          locale: 'es',
          buttonText: {
            today:    'Hoy',
            month:    'Mes',
            week:     'Semana',
            day:      'Dia',
            list:     'Lista'
          },
          selectable: true,
          navLinks: true, // can click day/week names to navigate views
          editable: false,
          events: 'calendario/event/',
          dateClick: function (info) {           
            var datos = {'fecha': info.dateStr};
            $.get('calendario/new/', datos, function (data) {
                $modal.find('.modal-title').html("Nuevo Evento");
                $modal.find('.modal-body').html(data);
                $modal.find('#myModalLabel').html('Agregar nuevo evento'); 
                $modal.modal('show');
            }, 'html');
        },
        eventClick: function (info) {
            idEvento = info.event._def.publicId; 
            $.get('calendario/edit/'+ idEvento, function (data) {
                $modal.find('.modal-title').html("Editar Evento");
                $modal.find('.modal-body').html(data);               
                $modal.modal('show');
            }, 'html');
        },       
    });
    
   
    calendar.render();

});