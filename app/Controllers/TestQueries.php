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

    
class TestQueries extends BaseController
{
    use ResponseTrait;

    protected $model;

    // public function __construct()
    // {
    //     $this->model = service('optionsModel');
    // }


    public function testPytania()
    {
        $db = \Config\Database::connect();

        $model = new QueriesCardsModel($db);
        
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
    public function getOptionsForUser($user_id)
    {
        //$db = \Config\Database::connect();

        $result = $this->optionsModel->getOptionsByUserId($user_id);

//         var_dump('wygląd tablicy', $result);
// exit;
        return $this->respond($result, 200);
    }
}