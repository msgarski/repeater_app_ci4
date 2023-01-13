<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>hasło zmienione<?= $this->endsection() ?>

<?= $this->section('content') ?>

<h1>hasło zostało zmienione</h1>



    <div>
        <a href=" <?= site_url('/home/index')  ?>"><button>Wyjście</button></a>
    </div>

<?= $this->endsection() ?>
