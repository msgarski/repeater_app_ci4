<?php 

namespace App\Entities;

use App\Libraries\Token;

class UserEntity extends \CodeIgniter\Entity
{
    public function activationByCode()
    {
        $token = new Token;

        $this->token = $token->getValue();

        $this->activation_hash = $token->getHashValue();
    }

    public function activateUser()
    {
        $this->is_active = true;
        
        // ! tu się wykrzacza: po odkomentowaniu, gryzie się z rekordami
        // ! które mają wartość null w polu activation_hash w tabeli user
        //$this->activation_hash = null;
    }

    
    public function resetPassword()
    {
        $token = new Token;

        $this->reset_token = $token->getValue();

        $this->reset_hash = $token->getHashValue();

        $this->reset_expires_at = date('Y-m-d H:i:s', time()+3600);
    }
}