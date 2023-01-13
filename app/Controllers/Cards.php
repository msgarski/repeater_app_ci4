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
        
            //$data['recent'] = $this->model->amountOfCards();
            
            return $this->respond('słowo zapisane', 200);            
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

        $mass = new MassCardInput;                              // create instance of massCardsInput class

        $http = $this->request->getJSON();
       
        // może array()?
        $lesson_id = $http->lessId;

        $priority = $http->priority;
        // var_dump('na serwerze', $http->priority);
        // exit;
        $cardsAsString = $http->cardsInput; // pobranie zawartości pola textarea formularza
        
        $score = $mass->cardsInputFormatting($cardsAsString);

        $result = $mass->createCards($score, $lesson_id, $priority);

        if($result)
        {
            return $this->respond('zapis wielu słów udany', 200);
        }
        else
        {
            return $this->respond('nie udało się zapisać słów', 401);
        }
    }
    public function fillLessonTable($lesson_id)
    {
        $result = $this->model->getCardsforLesson($lesson_id);
        // var_dump($result);
        // exit;

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
        // var_dump('karta do updatu', $card_id);
        // exit; 

        $http = $this->request->getJSON();

        $data = [
            'priority'      =>  $http->priority,
            'question'      =>  $http->question,
            'anser'         =>  $http->answer,
            'pronounciation'    =>  $http->pronounciation,
            'sentence'          =>  $http->sentence,
            'image'             =>  $http->image
        ];

        $this->model->updateCard($card_id, $http);

        return $this->respond('udało się updatować kartę ', 200);

    }
}