<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLearningLimitsTable extends Migration
{
	public function up()
	{
		$fields = [
			'learning_limit_id'          	=> [
				'type'          => 'TINYINT',
				'constraint'    => 2,
				'unsigned'      => true,
				'auto_increment'=> true
			],
			'limit'			=>	[
				'type'          => 'INT',
				'constraint'    => 3,
				'unsigned'      => true,
                'unique'        =>  true,
				'default'		=>	5
			],
	];

        $this->forge->addField($fields);

        $this->forge->addKey('learning_limit_id', true);

        $this->forge->createTable('learning_limit');
	}

	public function down()
	{
		$this->forge->dropTable('learning_limit');
		
	}
}
