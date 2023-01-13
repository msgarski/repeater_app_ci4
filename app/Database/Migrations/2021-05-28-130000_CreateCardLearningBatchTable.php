<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCardLearningBatchTable extends Migration
{
	public function up()
	{
		$fields = [
			'batch_id' => [
				'type'          => 'INT',
				'constraint'    => 7,
				'unsigned'      => true,
			],
            'card_id'          	=> [
				'type'          => 'INT',
				'constraint'    => 7,
				'unsigned'      => true,
			],
			'created_at'		=> [
				'type'     		=> 'DATETIME',
				'null'     		=> true,
				'default'  		=> null
			]
	];

        $this->forge->addField($fields);
		$this->forge->addForeignKey('card_id','card','card_id');
		$this->forge->addForeignKey('batch_id','learning_batch','learning_batch_id');


        $this->forge->createTable('card_learning_batch');
	}

	public function down()
	{
		$this->forge->dropForeignKey('card_learning_batch','card_learning_batch_batch_id_foreign');
		$this->forge->dropForeignKey('card_learning_batch','card_learning_batch_card_id_foreign');
		$this->forge->dropTable('card_learning_batch');
		
	}
}
