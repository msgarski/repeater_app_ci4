<?= $this->extend("layouts/main") ?>

<?= $this->section("title") ?>Resetowanie hasła<?= $this->endsection() ?>

<?= $this->section("content") ?>

<h1>Resetowanie hasła</h1>

<p>Na Twoją skrzynkę mailową, wysłaliśmy link do zmiany hasła do konta</p>


<div>
    <a href=" <?= site_url('/home/index')  ?>"><button>Powrót do strony logowania</button></a>
</div>

<?= $this->endsection() ?>