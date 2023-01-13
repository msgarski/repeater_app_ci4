<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
use Faker\Provider\Base;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use function PHPUnit\Framework\isJson;

class Login extends ResourceController
{
    use ResponseTrait;

    public function entering()
    {

        // var_dump('user data entering');
        // exit;

        helper('jwt_helper');

        $http = $this->request->getJSON();

        $email = $http->email;

       

        $password = $http->password;
        
        
        $authentic = service('authentication');
        
        $userData = $authentic->loginAuthentication($email, $password);

        switch($userData)
        {
            case null:
                return $this->respond('user not found', 404);
                break;
            case -1:
                return $this->respond('user is not active', 403);
                break;
            case -2:
                return $this->respond('authorization failed', 401);
                break;
        }

        $userId = $userData[0];

        $userEmail = $userData[1];
        
        
        if($userId)
        {   
            $jwt = getSignedJWTForUser($userEmail);

            $response = [
                'token'    =>  $jwt,
                'userId'    =>  $userId
            ];
            
            return $this->respond($response, 200);
        }
        else
        {
            var_dump('NIE udalo sie zalogować');
            exit;
            return $this->respond('Nieprawidlowe dane logowania', 200);
        }   
    }

    public function success()
    {
        return view('Porch/porch_view');
    }

    public function exiting()
    {
        $authentic = service('authentication');

        $authentic->logout();

        return redirect()->to('/')
                        ->with('info', 'Wylogowano');
    }
}

