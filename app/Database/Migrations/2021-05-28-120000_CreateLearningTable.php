<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLearningTable extends Migration
{
	public function up()
	{
		$fields = [
			'learning_batch_id'          	=> [
				'type'          => 'INT',
				'constraint'    => 7,
				'unsigned'      => true,
				'auto_increment'=> true
			],
            'tries_median'			=>	[
				'type'          => 'TINYINT',
				'constraint'    => 2,
				'unsigned'      => true,
				'default'		=>	null
			],
			'words_amount'			=>	[
				'type'          => 'TINYINT',
				'constraint'    => 2,
				'unsigned'      => true,
				'default'		=>	null
			],
			'created_at'	=> [
				'type'     		=> 'DATETIME',
				'null'     		=> true,
				'default'  		=> null
			],
			'updated_at'    => [
				'type'     		=> 'DATETIME',
				'null'     		=> true,
				'default'  		=> null
			]
	];

        $this->forge->addField($fields);

        $this->forge->addKey('learning_batch_id', true);

        $this->forge->createTable('learning_batch');
	}

	public function down()
	{
		$this->forge->dropTable('learning_batch');
		
	}
}
