<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRepeatLimitsTable extends Migration
{
	public function up()
	{
		$fields = [
			'repeat_limit_id'          	=> [
				'type'          => 'TINYINT',
				'constraint'    => 2,
				'unsigned'      => true,
				'auto_increment'=> true
			],
			'limit'			=>	[
				'type'          => 'INT',
				'constraint'    => 3,
				'unsigned'      => true,
				'unique'		=>	true,
				'default'		=>	10
			],
	];

        $this->forge->addField($fields);

        $this->forge->addKey('repeat_limit_id', true);

        $this->forge->createTable('repeat_limit');
	}

	public function down()
	{
		$this->forge->dropTable('repeat_limit');
		
	}
}
