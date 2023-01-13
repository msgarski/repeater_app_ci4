<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Dodaj kurs<?= $this->endsection() ?>

<?= $this->section('content') ?>

<h1>Dodaj Kurs</h1>


<a href=" <?= site_url('/login/exiting')  ?>">Wyloguj</a>
<div>
    <?= form_open("/course/createCourse") ?>

    <div>
        <label for="name">Nazwa</label>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <label for="description">Opis</label>
        <textarea rows="5" cols="50" id="description" name="description" placeholder="Tematyka kursu..."></textarea>
    </div>

    <div>
        <label for="genre">Rodzaj</label>
        <select name="genre" id="genre">
            <option default>Prywatny</option>
            <option>Publiczny</option>
        </select>
    </div>

    <button>Dodaj kurs</button>
    
    </form>
</div>

<div>
    <a href="<?= site_url('/porch/getinto')  ?>">Anuluj</a>
</div>



<?= $this->endsection() ?>