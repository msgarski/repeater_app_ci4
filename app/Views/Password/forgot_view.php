<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Nowe hasło<?= $this->endsection() ?>

<?= $this->section('content') ?>

<h1>Resetowanie hasła</h1>

<?= form_open("/password/checking") ?>

        <div>
        <label for="email">Adres email</label>
        <input type="text" name="email" id="email" value="<?= old("email") ?>">
        </div>

        <button>Wyślij</button>

    </form>

    <div>
        <a href=" <?= site_url('/home/index')  ?>"><button>Wyjście</button></a>
    </div>

<?= $this->endsection() ?>
