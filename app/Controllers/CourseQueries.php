<?php

namespace App\Controllers;

use App\Models\QueriesCardsModel;
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

    
class CourseQueries extends BaseController
{
    use ResponseTrait;

    protected $model;


    public function getFullInfoOfUserLessons($user_id){
        $db = \Config\Database::connect();

        $model = new QueriesCardsModel($db);
        // var_dump('w pytaniu o lessons');
        // exit;
        if ($db && $user_id) 
        {
            $result = $model->getFullInfoOfUserLessons($user_id);
            
            return $this->respond($result, 200);            
        } 
        else 
        {
            // var_dump('nieudane zapisanie', $data['user_id']);
            // exit;
            return $this->respond('pobranie danych nieudane!!!', 401);
        }
    }
    public function getFullInfoOfUserCourses($user_id = null)
    {
        $db = \Config\Database::connect();

        $model = new QueriesCardsModel($db);
        
        if ($db && $user_id) 
        {
            $result = $model->getFullInfoOfUserCourses($user_id);
            
            return $this->respond($result, 200);            
        } 
        else 
        {
            // var_dump('nieudane zapisanie', $data['user_id']);
            // exit;
            return $this->respond('pobranie danych nieudane!!!', 401);
        }
    }

    public function updateOptions()
    {
        $db = \Config\Database::connect();

        $http = $this->request->getJSON();

        $user_id = $http->userId;

        $data = [
            'day_learning_limit'    =>  $http->learningLim,
            'batch_learning_limit'  =>  $http->learningBatch,
            'day_repeat_limit'      =>  $http->repeatLim,
            'overlearning'          =>  $http->overlearn
        ];
        // var_dump('moje dane', $this->optionsModel);
        // exit;
        if ($db && $user_id) 
        {
            $builder = $db->table('options');//! to pytanie można przenieść do modelu

            $builder->where('user_id', $user_id);

            $builder->update($data);
            
            return $this->respond('opcje uaktualnione', 200);            
        } 
        else 
        {
            var_dump('nieudane zapisanie', $data['user_id']);
        exit;
            return $this->respond('update opcji nieudany', 401);
        }
    }
}