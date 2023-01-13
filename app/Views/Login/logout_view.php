<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Wyjście<?= $this->endsection() ?>

<?= $this->section('content') ?>

<h1>Wyjście</h1>

<p>Wylogowano</p>

<?php if(session()->has('user_id')): ?>
<!-- tutaj sesja nadal istnieje pomimo jej zniszczenia i dopiero po refreshu się to zmienia -->
<p>nadal jesteś zalogowany</p> 

<?php else: ?>

<p>Nie jesteś zalogowany</p>
<a href=" <?= site_url('/') ?>">Zaloguj się ponownie</a>

<?php endif ?>

<?= $this->endsection() ?>