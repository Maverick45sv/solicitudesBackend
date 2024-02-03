<?= $this->extend('plantilla') ?>

<?= $this->section('content') ?>
    <form action="ingresar" method="post">
        <?= csrf_field() ?>
        <input type="text" name="user" id="user">
        <input type="password" name="pass" id="pass">
        <input type="submit" value="ingresar">
    </form>
<?= $this->endSection() ?>