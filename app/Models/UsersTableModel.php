<?php

namespace App\Models;

use App\Libraries\Token;

class UsersTableModel extends \CodeIgniter\Model
{
    protected $table = 'user';

    protected $primaryKey = 'user_id';

    protected $allowedFields = ['name',
                                'email',
                                'password',
                                'activation_hash',
                                'reset_hash',
                                'reset_expires_at'
                            ];

    // tutaj okreslam klasę odpowiedzialną za tworzenie obiektu user:
    protected $returnType = 'App\Entities\UserEntity';

    protected $useTimestamps = true;

    protected $validationRules = [
        'name'                  =>  'required',
        'email'                 =>  'required|valid_email|is_unique[user.email]',
        'password'              =>  'required|min_length[6]',
        'password_confirmation' =>  'required|matches[password]'
    ];

    protected $validationMessages = [
        'name'  => [
                    'required'      => 'Imię jest wymagane'
        ],
        'email' => [
                    'required'      => 'Adres e-mail jest wymagany',
                    'is_unique'     => 'Istnieje już konto dla podanego adresu',
                    'valid_email'   => 'Nieprawidłlowy format adresu email'
        ],
        'password' => [
                    'required'      => 'Wymagane jest podanie hasła',
                    'min_length[6]' => 'Hasło powinno mieć długość min 6 znaków'
        ],
        'password_confirmation'     => [
                    'required'      => 'Potwierdź hasło',
                    'matches'       => 'Wprowadzone hasła nie są identyczne',
                    'min_length[6]' => 'Długość hasło to min 6 znaków'
        ]
    ];

    protected $beforeInsert = ['hashPassword'];

    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        //dd($data);
        if(isset($data['data']['password']))
        {
            $data['data']['password_hashed'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            unset($data['data']['password']);
        }

        return $data;
    }

    public function findUserByToken($token)
    {
        $token = new Token($token);

        $token_hash = $token->getHashValue();

        // var_dump($token_hash);
        // exit;

        $user = $this->where('activation_hash', $token_hash)
                    ->first();
        
        return $user;
    }

    public function findUserByTokenForReset($token)
    {
        $token = new Token($token);

        $token_hash = $token->getHashValue();

        $user = $this->where('reset_hash', $token_hash)
                    ->first();
                    // var_dump('moj hash tokena: ', $user->user_id);
                    // exit;
        return $user;
    }


    public function activateByToken($token)
    {
        // todo: poniższa konsolidacja do sprawdzenia:
        $user = $this->findUserByToken($token);
        // var_dump($user);
        // exit;
        if($user !== null)
        {
            $user->activateUser();
        
            $this->protect(false) // chwilowe usunięcie ograniczenia allowedFields
                    ->save($user);
        }

        $check = $this->getUserByEmail($user->email);

        if($check->is_active)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }

    public function checkTokenForResetPass($token)
    {
        $user = $this->findUserByToken($token);

        if($user && ($user->reset_expires_at > date('Y-m-d H:i:s', time())))
        {
            // $data = ['password_hashed'   =>  '1234'];
            // $this->protect(false)
            //         ->update($user->user_id, $data);
            return $user;
        }
        else
        {
            return $user;
        }   

        
    }

    public function getUserByEmail($email)
    {
        $user = $this->where('email', $email)
                        ->first();
        return $user;
    }
}