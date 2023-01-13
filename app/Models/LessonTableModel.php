<?php

namespace App\Models;

class LessonTableModel extends \CodeIgniter\Model
{
    protected $table = 'lesson';

    protected $primaryKey = 'lesson_id';

    protected $allowedFields = [
                            'name',
                            'description',
                            'course_id',
                            ];

    // tutaj okreslam klasę odpowiedzialną za tworzenie obiektu user:
    protected $returnType = 'App\Entities\LessonEntity';

    protected $useTimestamps = true;

    protected $validationRules = [
    ];

    protected $validationMessages = [
    ];

    public function getAllLessonsByUserId($userId)
    {
        //! funkcja na razie nieczynna
        // return $this->where('user_id', $userId)
        //                 ->findAll();
    }

    public function getAllLessonsByCourseId($courseId)
    {
        return $this->where('course_id', $courseId)
                    ->findAll();
    }

    public function getLessonByLessonId($lessonId)
    {
        return $this->where('lesson_id', $lessonId)
                    ->first();
    }

    
}