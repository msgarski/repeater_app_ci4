<?php 

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\Controller;
use Faker\Provider\Base;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use function PHPUnit\Framework\isJson;
use App\Controllers\Porch;


class Lesson extends ResourceController
{
    use ResponseTrait;

    private $lessonModel;

    public function __construct()
    {
        $this->lessonModel = service('lessonModel');
    }


    public function create()
    {
        /*
        *   methods for creating new lesson inside specific course
        *
        */
        
        $http = $this->request->getJSON();

        $lesson = [
            'name'  =>  $http->name,
            'description'   =>  $http->description,
            'course_id' =>  $http->courseId,
        ];

        // var_dump('w kontrolerze ', $lesson);
        // exit;

        if ($this->lessonModel->insert($lesson)) 
        {          
            return $this->respond('udalo sie', 200);
        } 
        else 
        {
            return $this->respond('error jakiś', 401);
        }
    }
















    // public function getInsideLesson($lessonId)
    // {
    //     $lesson = $this->lessonModel->getLessonByLessonId($lessonId);

    //     return view('Lessons/lesson_view', ['lessonInfo' => $lesson]);
    // }

    
}