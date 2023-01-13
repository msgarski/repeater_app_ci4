<?php

namespace App\Models;

class OptionsTableModel extends \CodeIgniter\Model
{
    protected $table = 'options';

    protected $allowedFields = [
                        'user_id',
                        'overlearning',
                        'batch_learning_limit',
                        'day_learning_limit',
                        'day_repeat_limit',
                        'fast_repeat_batch'
                            ];

    // tutaj okreslam klasę odpowiedzialną za tworzenie obiektu user:
    protected $returnType = 'App\Entities\OptionsEntity';

    //protected $useTimestamps = true;

    protected $validationRules = [
    ];

    protected $validationMessages = [
    ];

    public function getOptionsByUserId($userId)
    {
        // var_dump('wew modelu: ', $userId);
        // exit;
        return $this->select('overlearning,
                                batch_learning_limit,
                                day_learning_limit,
                                day_repeat_limit')
                    ->where('user_id', $userId)
                    ->get()
                    ->getRow();
    }
}