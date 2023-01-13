<?php

namespace App\Controllers;

use App\Models\QueriesRepeatModel;
use App\Libraries\MassCardInput;
use App\Libraries\Queries;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\Controller;
use Faker\Provider\Base;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use function PHPUnit\Framework\isJson;
use App\Controllers\Porch;

//class User extends ResourceController - może tak?

    
class RepeatQueries extends BaseController
{
    use ResponseTrait;

    protected $model;

    public function getRepeatBatchForCourse($course_id, $batch_limit = 10)
    {
        $db = \Config\Database::connect();
        
        $model = new QueriesRepeatModel($db);

        if ($db && $course_id) 
        {
            $result = $model->getRepeatBatchForCourse($course_id, $batch_limit);
            
            return $this->respond($result, 200);            
        } 
        else 
        {
            return $this->respond('pobranie danych nieudane!!!', 401);
        }
    }
    public function getRepeatsNumsForCourses($user_id)
    {
        $db = \Config\Database::connect();
        
        $model = new QueriesRepeatModel($db);

        if ($db && $user_id)
        {
            $result = $model->getRepeatsNumsForCourses($user_id);
            
            return $this->respond($result, 200);            
        } 
        else 
        {
            return $this->respond('pobranie danych nieudane!!!', 401);
        }
    }







    // public function getFullInfoOfUserCourses($user_id = null)
    // {
    //     $db = \Config\Database::connect();

    //     $model = new QueriesCardsModel($db);
        
    //     if ($db && $user_id) 
    //     {
    //         $result = $model->getFullInfoOfUserCourses($user_id);
            
    //         return $this->respond($result, 200);            
    //     } 
    //     else 
    //     {
    //         // var_dump('nieudane zapisanie', $data['user_id']);
    //         // exit;
    //         return $this->respond('pobranie danych nieudane!!!', 401);
    //     }
    // }

    
}