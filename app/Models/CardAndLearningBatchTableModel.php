<?php

namespace App\Models;

class CardAndLearningBatchTableModel extends \CodeIgniter\Model
{
    protected $table = 'card_learning_batch';

    protected $allowedFields = [
                        'batch_id',
                        'card_id',
                        'created_at'
                            ];

    // tutaj okreslam klasę odpowiedzialną za tworzenie obiektu user:
    protected $returnType = 'App\Entities\CardAndlearningBatchEntity';

    protected $useTimestamps = true;

    protected $validationRules = [
    ];

    protected $validationMessages = [
    ];
}