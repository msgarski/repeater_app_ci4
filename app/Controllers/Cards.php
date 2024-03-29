<?php

namespace App\Controllers;

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

//class Course extends ResourceController

    


class Cards extends BaseController
{
    use ResponseTrait;

    private $model;

    public function __construct()
    {
        $this->model = service('cardModel');
    }

    public function index($lessonId, $amount)
    {
        if(session()->has('user_id'))
        {
            //$placeholder = "pytanie odpowiedź [wymowa] [zdanie przykładowe] \n";
            //$userId = session()->get('user_id');
            // $data = [
            //     'user_id' => $userId,
            //     'lesson_id' => $lessonId,
            //     'before' => 0,
            //     'recent' => $qrs->amountOfUserCards($userId)
            // ];

            //! ilość kart usera się przyda, ale user_id trzebaa brać inaczej niż z sesji
            //$qrs->amountOfUserCards($userId)
            if($amount == 1)                                     // single input option
            {
                return view('Input/singleInput_view');
            }
            else                                                // mass input option
            {
                //$data['placeholder'] = $placeholder.$placeholder.$placeholder;

                return view('Input/massInput_view');
            }
        
        }
        // todo : else wyrzuć błąd braku zalogowania
    }

    public function createCard()
    {
        /*
        *   this method gets new card data from form and
        *   save them as new record in cardTable
        */
        $http = $this->request->getJSON();
        
        $card = [
            'question'          =>  $http->question,
            'answer'            =>  $http->answer,
            'pronounciation'    =>  $http->pronounciation,
            'sentence'          =>  $http->sentence,
            'image'             =>  $http->image,
            'lesson_id'         =>  $http->lessonId,
            'priority'          =>  $http->priority
        ];
        
        if ($this->model->insert($card)) 
        {
            helper('jwt_helper');
            $jwt = getSignedJWTForUserIdNumber($http->user_id);
            //$data['recent'] = $this->model->amountOfCards();
            
            return $this->respond($jwt, 200);            
        } 
        else 
        {
            return $this->respond('zapis nieudany', 401);
        }
    }
    public function createManyCards()
    {
        /*
        *   method gets data of multiple cards from textarea
        *   and save them in cardTable
        */


        // log_message(5,'jestem w create many cards: ');

        $mass = new MassCardInput;   

        $http = $this->request->getJSON();
       
        // może array()?
        $lesson_id = $http->lesson_id;

        $priority = $http->priority;
       
        $cardsAsString = $http->cardsInput;
        
        $score = $mass->cardsInputFormatting($cardsAsString);

        $result = $mass->createCards($score, $lesson_id, $priority);

        if($result)
        {
            helper('jwt_helper');
            $jwt = getSignedJWTForUserIdNumber($http->user_id);
            return $this->respond($jwt, 200);
        }
        else
        {
            return $this->respond('nie udało się zapisać słów', 401);
        }
    }
    public function fillLessonTable($lesson_id)
    {
        $result = $this->model->getCardsforLesson($lesson_id);

        if($result)
        {
            return $this->respond($result, 200);
        }
        else
        {
            return $this->respond('nie udało się pobrać słów do lekcji...', 404);
        } 
    }
    public function deleteCard($card_id)
    {
        // var_dump('id karty', $card_id);
        // exit;
        //$http = $this->request->getJSON();

        $result = $this->model->deleteCard($card_id);

        if($result)
        {
            return $this->respond($result, 200);
        }
        else
        {
            return $this->respond('nie udało się usunąć karty...', 404);
        } 
    }
    public function updateCard($card_id)
    {
        $http = $this->request->getJSON();

        $data = [
            'priority'      =>  $http->priority,
            'question'      =>  $http->question,
            'anser'         =>  $http->answer,
            'pronounciation'    =>  $http->pronounciation,
            'sentence'          =>  $http->sentence,
            'image'             =>  $http->image
        ];

        if($this->model->updateCard($card_id, $http))
        {
            return $this->respond('udało się updatować kartę ', 200);
        }
        else
        {
            return $this->respond('error jakiś', 401);
        }
        


    }
}