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

class Course extends ResourceController
{
    use ResponseTrait;

    protected $courseModel;

    public function __construct()
    {
        $this->courseModel = service('courseModel');
    }

    public function createCourse()
    {
        $http = $this->request->getJSON();

        $course = [
            'user_id'   =>  $http->user_id,
            'name'      =>  $http->name,
            'description'   =>  $http->description
        ];
       // 'genre_id'  =>  $http->genre_id,
        if ($this->courseModel->insert($course)) 
        {         
            return $this->respond('kurs zapisany', 200);
        } 
        else 
        {
            return $this->respond('błąd danych', 401);
        }
    }

    public function getInsideCourse($courseId)
    {
        /*
        *   method for conveying specific course data (found by courseId), 
        *   to this course view
        */
        // var_dump('w kontrolerze lekcjow');
        // exit;
        $lessonModel = service('lessonModel');

        $data = $lessonModel->getAllLessonsByCourseId($courseId);
        // var_dump('w kontrolerze lekcjow', $data);
        // exit;

        return $this->respond($data);
    }

    public function getAllCoursesForUser($user_id = null)
    {
        /*
        *   This method conveys info about user's courses to main view
        *   
        */
        // var_dump($user_id);
        // exit;
        if($user_id)
        {
            $data = $this->courseModel->getAllCoursesByUserId($user_id);
            //$data = $this->courseModel->
            
            return $this->respond($data);
        }
        else
        {
            return $this->respond("Brak użytkownika", 404);
        }
    }
    public function getFullInfoOfUserCourses($user_id)
    {
        if($user_id)
        {
            $data = $this->courseModel->getAllCoursesByUserId($user_id);
            //$data = $this->courseModel->
            
            return $this->respond($data);
        }
        else
        {
            return $this->respond("Brak użytkownika", 404);
        }
    }
}