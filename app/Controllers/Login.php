<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
// use App\Controllers\BaseController;
// use CodeIgniter\Log\Handlers\ChromeLoggerHandler;
// use App\Models\ProductModel;
// use Faker\Provider\Base;
// use phpDocumentor\Reflection\DocBlock\Tags\Var_;
// use function PHPUnit\Framework\isJson;
// use $_SERVER['DOCUMENT_ROOT'] . '/ChromePhp.php';

class Login extends ResourceController
{
    // ! delete log_message() before production !!!!
    // ChromePhp::log('Hello console!');
    // error_log(print_r($_SERVER['DOCUMENT_ROOT'], true), 3, 'my.log');
    use ResponseTrait;

    public function entering()
    {

// log_message(8,'Some 8variable did not contain a value.');

        

        $http = $this->request->getJSON();

        $email = $http->email;
// log_message(5,'Some 4ariable did not contain a value: '.$email);

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
        $userName = $userData[2];
        
        if($userId)
        {   
            helper('jwt_helper');
            $jwt = getSignedJWTForUser($userEmail);

            $response = [
                'token'    =>  $jwt,
                'userId'    =>  $userId,
                'userName' => $userName
            ];
            
            return $this->respond($response, 200);
        }
        else
        {
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
?>
