<?php

namespace App\Controllers\RestApi;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use function PHPUnit\Framework\isJson;

class Login extends ResourceController
{
    use ResponseTrait;

    public function entering()
    {
        var_dump('w drugim login entering');
        exit;

        $http = $this->request->getJSON();

        $email = $http->email;

        $password = $http->password;

        $authentic = service('authentication');
        
        if($authentic->loginAuthentication($email, $password))
        {
            return $this->respond('Logowanie udane', 200);
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

