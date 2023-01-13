<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Nowe hasło<?= $this->endsection() ?>

<?= $this->section('content') ?>

<h1>Nowe hasło</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>

<?= form_open("password/newPassword/$token") ?>

<p>Wprowadź nowe hasło:</p>

<div>
    <label for="password">Podaj hasło</label>
    <input type="password" name="password">
</div>

<div>
    <label for="password_confirmation">Powtórz hasło</label>
    <input type="password" name="password_confirmation">
</div>

<button>Wyślij</button>

</form>

<?= $this->endsection() ?>