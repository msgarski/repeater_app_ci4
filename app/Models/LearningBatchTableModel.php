<?php

namespace App\Models;

class LearningBatchTableModel extends \CodeIgniter\Model
{
    protected $table = 'learning_batch';

    protected $allowedFields = [
                            'tries_median',
                            'words_amount',
                            'created_at'
                            ];

    // tutaj okreslam klasę odpowiedzialną za tworzenie obiektu user:
    protected $returnType = 'App\Entities\LearningEntity';

    protected $useTimestamps = true;

    protected $validationRules = [
    ];

    protected $validationMessages = [
    ];
}