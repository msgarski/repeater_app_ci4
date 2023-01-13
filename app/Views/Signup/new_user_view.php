<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Rejestracja<?= $this->endsection() ?>

<?= $this->section('content') ?>

<h1>Rejestracja</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>


<?= form_open("/signup/create") ?>

<div>
    <label for="name">Imię</label>
    <input type="text" name="name" id="name" value=" <?= old('name') ?>">
</div>

<div>
    <label for="email">Adres e-mail</label>
    <input type="text" name="email" id="email" value=" <?= old('email') ?>">
</div>

<div>
    <label for="password">Hasło</label>
    <input type="password" name="password" id="password">
</div>

<div>
    <label for="password_confirmation">potwierdź hasło</label>
    <input type="password" name="password_confirmation" id="password_confirmation">
</div>

<button>Stwórz konto</button>

</form>

<a href=" <?= site_url("/") ?>"><button>Wyjście</button></a>

<?php $this->endsection() ?>