<?php

namespace App\Controllers;

class Signup extends BaseController
{
    public function newUser()
    {
        return view("Signup/new_user_view");
    }

    public function create()
    {
        $user = new \App\Entities\UserEntity($this->request->getPost());
        dd($this->request->getPost());
        //dd($user);

        
        $model = service('userModel');

        $user->activationByCode();

        if ($model->insert($user)) {

            $this->sendActivationEmail($user);
        
            return redirect()->to("/signup/success");
            
        } 
        else 
        {
            return redirect()->back()
                             ->with('errors', $model->errors())
                             ->with('warning', 'Nieprawidłowe dane')
                             ->withInput();
        }
    }

    public function success()
    {
		return view('Signup/success_view');
    }

    public function activate($token)
    {
        $model = service('userModel');

        $model->activateByToken($token);

        return view('Signup/account_activated_view');
    }

    public function sendActivationEmail($user)
    {
        $email = service('email');

		$email->setTo($user->email);

		$email->setFrom('garski@wp.pl');

		$email->setSubject('Aktywacja konta');

        $message = view('Signup/activation_email_view', [
                    'token'     =>      $user->token
        ]);

		$email->setMessage($message);

		$email->send();
    }
}