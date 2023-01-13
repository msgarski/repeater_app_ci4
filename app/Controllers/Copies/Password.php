<?php

namespace App\Controllers;

use App\Entities\UserEntity;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class Password extends BaseController
{
    private $model;


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
        // var_dump(' moj email: ', $http->email);
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
                return redirect()->to('/password/afterResetIsSent');
            }
            else
            {
                //todo czy to się wyświetla userowi w vue?
                return redirect()->back()
                            ->withInput()
                            ->with('warning', "Podano nieprawidłowy adres email");
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
            return redirect()->to('http://localhost:8081/');
        }

        
    }

    public function newPassword($token)
    {
        $model = service('userModel');

        $user = $model->findUserByToken($token);

        if($user)
        {
            $user->fill($this->request->getPost());

            if($model->save($user))
            {

                return redirect()->to('/login/index')
                                    ->with('info', 'Możesz zalogować się teraz nowym hasłem');
            }
            else
            {
                return redirect()->back()
                                    ->with('errors', $model->error)
                                    ->with('warning', 'Nieprawidłowe dane nowego hasła');
            }

        }
        // to na górze, albo to poniżej:
        //return view('Password/acomplished_view');
    }
}