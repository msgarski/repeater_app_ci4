<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOptionFieldsToUserTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user', [
                    'overlearning'            =>  [
                            'type'          =>  'BOOLEAN',
                            'null'          =>  false, 
                            'default'       =>  true
                    ],
                    'batch_learning_limit'    =>  [
                            'type'          =>  'TINYINT',
                            'constraint'    =>  3,
                            'null'          =>  false,
                            'unsigned'      =>  true,
                            'default'       =>  0
                    ],
                    'day_learning_limit'      =>  [
                            'type'          =>  'TINYINT',
                            'constraint'    =>  3,
                            'null'          =>  false,
                            'unsigend'      =>  true,
                            'default'       =>  0
                    ],
                    'day_repeat_limit'        =>  [
                            'type'          =>  'INT',
                            'constraint'    =>  3,
                            'null'          =>  false,
                            'unsigned'      =>  true,
                            'default'       =>  0
                    ]
        ]);

    }
    public function down()
    {
        $this->forge->dropColumn('user','overlearning,
                                        batch_learning_limit,
                                        day_learning_limit,
                                        day_repeat_limit'
                                    );
    }
}