<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
use CodeIgniter\Controller;
use Faker\Provider\Base;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use function PHPUnit\Framework\isJson;

class Password extends ResourceController
{
    use ResponseTrait;

    protected $model;


    public function __construct()
    {
        $this->model = service('userModel');
    }
    
    public function getModel()
    {
        return $this->model;
    }

    public function forgot()
    {
        return view('Password/forgot_view');
    }

    public function checking()
    {
        // var_dump('wszystko oki');
        // exit;
        $http = $this->request->getJSON();

        // var_dump(' moj email z jsona: ', $http->email);
        // exit;
        $email = $http->email;
        if($email)
        {
            $userModel = $this->getModel();

            $user = $userModel->getUserByEmail($email);

            if($user&&($user->is_active == true))
            {
                $user->resetPassword();

                $userModel->save($user);

                $this->sendEmailWithResetToken($user);
                var_dump(' dotąd oki: ', $http->email);
                exit;
            }
            else
            {
                //var_dump(' brak usera : ', $http->email);
                //exit;
                return $this->respond('brak', 404);                
            }
        }
        else
        {
            return redirect()->back()
                            ->withInput()
                            ->with('warning', "Nie wpisano adresu email");
        }
    }

    public function afterResetIsSent()
    {
        return view('Password/email_info_view');
    }

    public function sendEmailWithResetToken($user)
    {
        $email = service('email');

		$email->setTo($user->email);

		$email->setFrom('garski@wp.pl');

		$email->setSubject('Odnowienie hasła');

        $message = view('Password/reset_email_view', [
                    'token'     =>      $user->reset_token
        ]);

		$email->setMessage($message);

		$email->send();
    }

    public function reseting($token)
    {
        
        $user = $this->model->checkTokenForResetPass($token);

        if($user)
        {
            return view('Password/new_password_view', ['token' => $token]);
        }
        else
        {
            return redirect()->to('http://localhost:8081/signin');
        }

        
    }
    public function newPassword($token)
    {
        $model = service('userModel');

        $user = $model->findUserByTokenForReset($token);
        

        if($user)
        {
                //! undefined method:
                $req = $this->request->getJSON();
            $newData = [
                'password'  =>  $req->password,
                'password_confirmation' =>  $req->password_confirmation
            ];
            
            $user->fill($newData);
            
            if($model->save($user))
            {
                var_dump(' hasło zapisane: ', $token);
                exit;
                $response = 'Możesz się zalogować teraz nowym hasłem';
                return $this->respond($response, 200);
            }
            else
            {
                $response = 'Nie znaleziono takiego użytkownika';
                return $this->respond($response, 401);   
            }
        }
    }
}