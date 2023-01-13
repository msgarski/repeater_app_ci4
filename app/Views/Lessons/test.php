<p>Twoje lekcje:</p>

<div>
    <ul>
        <?php foreach($lessons as $lesson): ?>      
            <li>
                <a href=" <?= site_url('/course/getInsideCourse').'/'.$course->id ?> "><?= esc($course->name)  ?></a>
            </li> 
        <?php endforeach; ?>
    </ul>
</div>