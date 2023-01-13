<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
	public function up()
	{
		$fields = [
			'user_id'          => [
					'type'           => 'INT',
					'constraint'     => 7,
					'unsigned'       => true,
					'auto_increment' => true
			],
			'name'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'unique'         => false,
			],
			'email'      => [
					'type'           => 'VARCHAR',
					'constraint'	 => '255',
			],
			'password_hashed' => [
					'type'           => 'VARCHAR',
					'constraint'	 => '255',
			],
			'created_at'      => [
					'type'     => 'DATETIME',
					'null'     => true,
					'default'  => null
			],
			'updated_at'      => [
					'type'     => 'DATETIME',
					'null'     => true,
					'default'  => null
			],
			'activation_hash'	=> [
					'type'			=>	'VARCHAR',
					'constraint'	=> 	64,
					'unique'		=>	true
			],
			'is_active'			=> [
					'type'			=>	'BOOLEAN',
					'null'			=>	false,
					'default'		=>	false
			],
			'is_admin'			=>	[
					'type'			=>	'TINYINT',
					'constraint'	=>	1,
					'default'		=>	0
			]
	];

	$this->forge->addField($fields);
	$this->forge->addKey('user_id', true);

	$this->forge->createTable('user');
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
