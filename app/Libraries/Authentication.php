<?php

namespace App\Libraries;

class Authentication
{
    public function loginAuthentication($email, $password = null)
    {  
        $model = service('userModel');

        $user = $model->where('email', $email)
                    ->first();
        
        if($user === null)
        {
            return $user;
        }

        if($password !== null)
        {
            if( ! password_verify($password, $user->password_hashed))
            {
                return -2;
            }
            elseif(!$user->is_active)
            {
                // user is not activated yet:
                return -1;
            }
        }
        
        $userData = [$user->user_id,
                    $user->email,
                    $user->name
                ];
        //  var_dump($userData);
        // exit;      
        return $userData;
    }









    
    // public function getCurrentUser()
    // {
    //     var_dump('session is not active!');
    //     exit;
    //     // if(!session()->has('user_id'))
    //     // {
    //     //     return null;
    //     // }
    //     // $model = service('userModel');
    //     // return $model->find(session()->get('user_id'));
    // }

    // public function logout()
    // {
    //     session()->destroy();
    // }
    
}