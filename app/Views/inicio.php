<?= $this->extend('plantilla') ?>
<?= $this->section('menu') ?>
    <?= $menu ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
      <h2>Bienvenido <?= $usuario->nombre ?></h2>       
<?= $this->endSection() ?>