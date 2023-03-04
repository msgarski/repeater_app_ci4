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
        // var_dump('jestem w password checking...');
        // exit;
        $http = $this->request->getJSON();

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
                
            }
            else
            {
                return $this->respond('brak usera...niestety', 404);                
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

		$email->setFrom('msgarski@gmail.com');


		$email->setSubject('Odnowienie hasła');

        $message = view('Password/reset_email_view', [
                    'token'     =>      $user->reset_token
        ]);

		$email->setMessage($message);

		$email->send();
    }
    public function testEmail(){
        // this function is only for testing sending emails in general
        $email = service('email');
        $email->setTo('msgarski@gmail.com');
		$email->setFrom('garski@wp.pl');
		$email->setSubject('Odnowienie hasła');
        $email->setMessage('<h1>Hello thats me</h1>');

        if($email->send()){
            echo "email sent! Success";
        } else {
            echo $email->printDebugger();
        }
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
            //todo tu trzeba zmienić port!
            return redirect()->to('http://localhost:8081/signin');
        }

        
    }
    public function newPassword($token)
    {
        // var_dump('moje dane', $token);
        // exit;
        $model = service('userModel');

        $user = $model->findUserByTokenForReset($token);
        

        if($user)
        {
                //! undefined method: o co chodzi???
                $req = $this->request->getJSON();
            $newData = [
                'password'  =>  $req->password1,
                'password_confirmation' =>  $req->password2
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
                $response = 'Nie zapisano podanego hasła - nie wiemy dlaczego...';
                return $this->respond($response, 408);   
            }
        }
        else{
            $response = 'Nie znaleziono użytkownika tego tokena';
                return $this->respond($response, 401);  
        }
    }
}