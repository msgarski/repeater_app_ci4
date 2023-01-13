<?php

namespace App\Models;

//use App\Libraries\Token;


class CardTableModel extends \CodeIgniter\Model
{
    protected $table = 'card';

    protected $primaryKey = 'card_id';

    protected $allowedFields = ['question',
                                'answer',
                                'pronounciation',
                                'sentence',
                                'image',
                                'answer_sound',
                                'lesson_id',
                                'learned_at',
                                'tries',
                                'summary',
                                'fast_repeat',
                                'awkward',
                                'overlearning',
                                'last_repeat', 
                                'next_repeat', 
                                'card_awareness',
                                'total_repetitions',
                                'success_repeatitions',
                                'priority',
                                'longest_period',
                                'multiplier',
                                'reverse_ready',
                                'oneday_repeat'
                            ];

    // tutaj okreslam klasę odpowiedzialną za tworzenie obiektu card:
    protected $returnType = 'App\Entities\CardEntity';

    protected $useTimestamps = true;

    protected $validationMessages = [];

    public function amountOfCards()
    {
        return $this->select('*')
                    ->countAllResults();
    }

    public function amountOfLessonCards($lessonId)
    {
        return $this->where('lesson_id', $lessonId)
                    ->countAllResults();

    }
    public function findCardById($card_id)
    {
        return $this->where('card_id', $card_id)
                    ->first();
    }
    public function getCardsForLesson($lesson_id)
    {
        // var_dump('w pytaniu ');
        // exit;
        return $this->select('*')  //! czy to dobrze zapisane
                    ->where('lesson_id', $lesson_id)
                    ->findAll();
    }
    public function deleteCard($card_id)
    {
        return $this->where('card_id', $card_id)
                    ->delete();
    }
    //public function updateCard

    public function updateCard($card_id, $http)
    {
        $data = [
            'question'              =>  $http->question,
            'answer'                =>  $http->answer,
            'pronounciation'        =>  $http->pronounciation,
            'sentence'              =>  $http->sentence,
            'image'                 =>  $http->image,
            'answer_sound'          =>  $http->answer_sound,
            'lesson_id'             =>  $http->lesson_id,
            'learned_at'            =>  $http->learned_at,
            'tries'                 =>  $http->tries,
            'summary'               =>  $http->summary,
            'fast_repeat'           =>  $http->fast_repeat,
            'awkward'               =>  $http->awkward,
            'overlearning'          =>  $http->overlearning,
            'last_repeat'           =>  $http->last_repeat, 
            'next_repeat'           =>  $http->next_repeat, 
            'card_awareness'        =>  $http->card_awareness,
            'total_repetitions'     =>  $http->total_repetitions,
            'success_repeatitions'  =>  $http->success_repeatitions,
            'priority'              =>  $http->priority,
            'longest_period'        =>  $http->longest_period,
            'multiplier'            =>  $http->multiplier,
            'reverse_ready'         =>  $http->reverse_ready,
            'oneday_repeat'         =>  $http->oneday_repeat
        ];
        
        $this->where('card_id', $card_id)
                ->set($data)
                ->update();
        return true;
    }





    // public function amountOfUserCards1($userId)
    // {
    //     return $this->select('card.question')
    //                 ->from('user')
    //                 ->join('course', 'course.user_id = user.user_id')
    //                 ->join('lesson', 'course.course_id = lesson.course_id')
    //                 ->join('card', 'lesson.lesson_id = card.lesson_id')
    //                 ->where('user.user_id', $userId);
                    
    // }

    // public function amountOfUserCards($userId)
    // {
    //     return $this->select('question')
    //                 ->join('course', 'course.user_id = user.id')
    //                 ->join('lesson', 'course.id = lesson.course_id')
    //                 ->join('card', 'lesson.id = card.lesson_id')
    //                 ->where('user.id', $userId)
    //                 ->findAll();
                    
    // }
}