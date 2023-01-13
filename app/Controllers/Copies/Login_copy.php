<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return view("Login/login_view");
    }

    public function entering()
    {
        $email = $this->request->getPost('email');

        $password = $this->request->getPost('password');

        $authentic = service('authentication');
        
        if($authentic->loginAuthentication($email, $password))
        {
            return redirect()->to('/login/success')
                            ->with('info', 'Logowanie udane');
        }
        else
        {
            return redirect()->back()
                            ->withInput()
                            ->with('warning', "Nieprawidłowy login lub hasło");
        }   
    }

    public function success()
    {
        // todo ta funkcja niepotrzebna bo nie ma widoków w vue....
        return view('Porch/porch_view');
    }

    public function exiting()
    {
        //todo ta funkcja będzie niepotrzebna bo wylogowanie będzie inne...
        $authentic = service('authentication');

        $authentic->logout();

        return redirect()->to('/')
                        ->with('info', 'Wylogowano');
    }
}

