<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddResetPasswordToUser extends Migration
{
	public function up()
	{
		$columns = [
			'reset_hash'		=>	[
				'type'			=>	'VARCHAR',
				'constraint'	=>	'64',
				'unique'		=>	true
			],
			'reset_expires_at'	=>	[
				'type'			=> 'DATETIME'
			]
		];

		$this->forge->addColumn('user', $columns);
	}

	public function down()
	{
		$this->forge->dropColumn('user', 'reset_expires_at');
		$this->forge->dropColumn('user', 'reset_hash');
	}
}
