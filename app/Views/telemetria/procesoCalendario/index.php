<?= $this->extend('plantilla_calendar') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <h4>Calendario de Procesos Academicos</h4>   
    <div id='calendar'></div>
       

    <!-- Modal -->
    <div class="modal fade" id="CalendarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-body">
            ...
        </div>
        </div>
    </div>
    </div>   
<?= $this->endSection() ?>