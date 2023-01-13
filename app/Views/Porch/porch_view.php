<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Przedsionek<?= $this->endsection() ?>

<?= $this->section('content') ?>

<h1>Przedsionek</h1>

<?php if(session()->has('user_id')): ?>

<p>witaj, <?= current_user()->name ?></p>

<?php endif ?>

<div>
    <a href=" <?= site_url('/login/exiting')  ?>">Wyloguj</a>
</div>

<div>
    <a href=" <?= site_url('/porch/repeatShortly')  ?>">Krótkie powtórki</a>
</div>

<div>
    <a href=" <?= site_url('/porch/tasks')  ?>">Zadania na dzisiaj</a>
</div>

<div>
    <a href=" <?= site_url('/porch/getInto')  ?>">Dalej</a>
</div>


<?= $this->endsection() ?>