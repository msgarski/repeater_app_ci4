<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Dodawanie lekcji<?= $this->endsection() ?>

<?= $this->section('content') ?>

<h1>Dodaj lekcję</h1>



<a href=" <?= site_url('/login/exiting')  ?>">Wyloguj</a>

<?= form_open('/lesson/create') ?>

<div>
    <label for="courseName">nazwa kursu: </label>
    <!-- <input type="text" name="courseName" id="courseName" > -->
</div>

<div>
    <label for="name">nazwa lekcji: </label>
    <input type="text" name="name" id="name" >
</div>

    <div>   
        <label for="description">Opis</label>
        <textarea rows="5" cols="50" id="description" name="description" placeholder="Tematyka lekcji..."></textarea>
    </div>

    <div>
        <input type="hidden" name="course_id" value="<?= $courseId ?>">
    </div>

<button>Zatwierdź</button>

</form>

<a href=" <?= site_url('/course/getInsideCourse/').$courseId  ?>">Anuluj</a>

<?= $this->endsection() ?>