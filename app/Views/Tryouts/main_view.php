<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Sprawdzian<?= $this->endsection() ?>

<?= $this->section('content') ?>

<h1>Sprawdzian</h1>


<a href=" <?= site_url('/login/exiting')  ?>">Wyloguj</a>





<?= $this->endsection() ?>