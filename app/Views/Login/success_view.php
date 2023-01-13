<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Zalogowano<?= $this->endsection() ?>

<?= $this->section('content') ?>

<h1>Sukces!</h1>

<?php if(session()->has('user_id')): ?>

<p>Jesteś zalogowany</p>

<?php else: ?>

<p>Nie jesteś zalogowany</p>

<?php endif ?>

<p></p>

<a href=" <?= site_url('/login/exiting')  ?>">Wyloguj</a>

<?= $this->endsection() ?>