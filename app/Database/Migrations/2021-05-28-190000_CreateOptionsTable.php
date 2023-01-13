<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOptionsTable extends Migration
{
	public function up()
	{
		$fields = [
                        'options_id'                    => [
                                'type'          =>'INT',
                                'constraint'    => 7,
                                'unsinged'      => true,
                                'auto_increment'        =>      true
                        ],
		        'user_id'          	=> [
                                'type'           => 'INT',
                                'constraint'     => 7,
                                'unsigned'       => true
			],
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
                                'type'          =>  'INT',
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
                        ],
                        'fast_repeat_batch'     =>      [
                                'type'          =>  'INT',
                                'constraint'    =>  3,
                                'null'          =>  false,
                                'unsigned'      =>  true,
                                'default'       =>  0
                        ]
	        ];

                $this->forge->addField($fields);

                $this->forge->addKey('options_id', true); //????

                $this->forge->addForeignKey('user_id','user','user_id');

                $this->forge->createTable('options');
	}

	public function down()
	{
                $this->forge->dropForeignKey('options','options_user_id_foreign');

	        $this->forge->dropTable('options');
		
	}
}
