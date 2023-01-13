<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Widok kursu<?= $this->endsection() ?>

<?= $this->section('content') ?>

<h1>Widok kursu: <?= $courseInfo->name ?></h1>

<a href=" <?= site_url('/login/exiting')  ?>">Wyloguj</a>

<div>
    <a href=" <?= site_url('/lesson/toNewLessonForm')."/".$courseInfo->id ?>">Dodaj nową lekcję</a>
    
</div>

<div>
    <p>
        Karty do nauki w tym kursie:
        <a href="<?= site_url('/study/presentation/').$courseInfo->id.'/'.$courseInfo->user_id ?>"><button>Ucz się</button></a>
    </p>
    
</div>

<div>
    Lekcje w tym kursie:
</div>

<div>
    <ul>
        <?php foreach($lessons as $lesson): ?>      
            <li>
                <a href=" <?= site_url('/lesson/getInsideLesson').'/'.$lesson->id ?> "><?= esc($lesson->name)  ?></a>
            </li> 
        <?php endforeach; ?>
    </ul>
</div>



<div>
    <a href="<?= site_url('/porch/getinto')  ?>">Powrót</a>
</div>

<?=  d($courseInfo) ?>

<?= $this->endsection() ?>