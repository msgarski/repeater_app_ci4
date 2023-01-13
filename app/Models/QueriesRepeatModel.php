<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class QueriesRepeatModel
{
    protected $db;
    
    public function __construct(ConnectionInterface &$db)
    {
        
        $this->db = &$db;
    }

    public function getRepeatsNumsForCourses($user_id)
    {
        $query = $this->db->query("
            SELECT course.name, lesson.course_id, COUNT(*) AS repeats
            FROM card
            JOIN lesson 
            ON lesson.lesson_id = card.lesson_id
            JOIN course
            ON course.course_id = lesson.course_id
            WHERE card.next_repeat < NOW() 
            AND lesson.course_id IN (SELECT course.course_id FROM course WHERE course.user_id = ".$this->db->escape($user_id).")
            GROUP BY lesson.course_id
        ;");

        return $query->getResult();
    }

    public function getRepeatBatchForCourse($course_id, $batch_limit)
    {
        /*
        *   Query for creating batch for repeating phase;
        *   Selection is based on periond between learning time and repeat date
        */

        $query = $this->db->query("
            SELECT *, timestampdiff(minute,card.learned_at, card.next_repeat) AS period,
            timestampdiff(minute, card.next_repeat, now()) as overlook, now() as now
            FROM card
            JOIN lesson
            ON lesson.lesson_id = card.lesson_id
            WHERE lesson.course_id = ".$this->db->escape($course_id)." 
            AND card.next_repeat < NOW()
            ORDER by period
            LIMIT ".$batch_limit."
        ;");

        return $query->getResult();
    }
    
    
    public function getFullInfoOfUserCourses($user_id)
    {
        $query = $this->db->query("
        select c.user_id, c.course_id, count(l.lesson_id) as lesson_amount, 
            (SELECT COUNT(*) FROM card WHERE card.lesson_id = l.lesson_id) as card_amount,
            (SELECT COUNT(*) FROM card WHERE card.lesson_id = l.lesson_id AND card.awkward = 1) as awkward_amount,
            (SELECT COUNT(*) FROM card WHERE card.lesson_id = l.lesson_id AND card.learned_at IS NULL) as for_learning,
            (SELECT COUNT(*) FROM card WHERE card.lesson_id = l.lesson_id AND card.next_repeat < NOW()) as for_repeating
                    from course as c
                    left join lesson as l
                    on c.course_id = l.course_id
                    WHERE c.user_id = " .$this->db->escape($user_id)."
                    group by c.course_id
            ;"
        );

        return $query->getResult();
        
    }

    public function updateCard($card_id)
    {
        $builder = $this->db->table('card');        

        $score = $builder->get();
        
        return $score->getResult();
    }

}
