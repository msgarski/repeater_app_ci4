<?= $this->extend("layouts/main") ?>

<?= $this->section("title") ?>Logowanie<?= $this->endsection() ?>

<?= $this->section("content") ?>


<h1>Witaj w programie REPEATER II</h1>

<?php if(current_user()): ?>

    <p>Witaj,<?= current_user()->name ?> !</p>

    <a href=" <?=  site_url('/login/exiting') ?>">Wyloguj</a>

<?php else: ?>

    <div>
        <a href=" <?= site_url('/login') ?>">Logowanie</a>
    </div>

    <div>
        <a href=" <?= site_url('/signup') ?>">Nie mam jeszcze konta</a>
    </div>

<?php endif; ?>






<?= $this->endsection() ?>
