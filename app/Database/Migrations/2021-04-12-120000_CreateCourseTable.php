<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCourseTable extends Migration
{
	public function up()
	{

        //todo dodatkowe pola, związane z opcjami, dodam póżniej
		$fields = [
			'course_id'          => [
					'type'           => 'INT',
					'constraint'     => 7,
					'unsigned'       => true,
					'auto_increment' => true
			],
            'user_id'          => [
                    'type'          => 'INT',
                    'constraint'    => 7,
                    'unsigned'      => true
            ],
			'name'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'unique'         => false,
			],
			'description'      => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '200',
                    'unique'         => false,
			],
			'genre_id' => [
					'type'           => 'VARCHAR',
					'constraint'	=>	'10',
                    'default'       =>  'Publiczny',
                    'null'          => false
			],
            'code'  =>  [
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  8,
                    'unique'        =>  false,
                    'default'       =>  null
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
			]
	];

	$this->forge->addField($fields);
	$this->forge->addKey('course_id', true);
    $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
	$this->forge->createTable('course', true);
	}

	public function down()
	{
        $this->forge->dropForeignKey('course', 'course_user_id_foreign');
		$this->forge->dropTable('course');
	}
}
