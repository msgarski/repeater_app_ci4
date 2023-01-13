<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCardTable extends Migration
{
	//! pole lesson_id powinno być wymagane!
	public function up()
	{
		$fields = [
			'card_id'          	=> [
				'type'          => 'INT',
				'constraint'    => 7,
				'unsigned'      => true,
				'auto_increment'=> true
			],
			'question'       => [
				'type'       	=> 'VARCHAR',
				'constraint'	=> '50',
				'null'			=>	true,
				'unique'     	=> false,
			],
			'answer'		=> [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'unique'        => false,
				'null'			=>	true,
            ],
            'pronounciation' => [
                'type'          =>  'VARCHAR',
                'constraint'    =>  '50',
                'default'       =>  null,
            ],
            'sentence'      =>  [
                'type'          =>  'VARCHAR',
                'constraint'    =>  '200',
                'default'       =>  null,
            ],
            'image'         =>  [
                'type'          =>  'BLOB',
				'default'		=>	null,
            ],
			'answer_sound'	=>	[
				'type'			=>	'BLOB',
				'default'		=>	null,
			],
			'learned_at'	=>	[
				'type'     		=> 'DATETIME',
				'null'     		=> true,
				'default'  		=> null
			],
			'tries'			=>	[
				'type'          => 'TINYINT',
				'unsigned'      => true,
				'default'		=>	null
			],
			'summary'		=>	[
				'type'			=>	'BOOLEAN',
				'null'			=>	false,
				'default'		=>	false
			],
			'fast_repeat'	=>	[
				'type'			=>	'BOOLEAN',
				'null'			=>	false,
				'default'		=>	false
			],
			'awkward'		=>	[
				'type'			=>	'BOOLEAN',
				'null'			=>	false,
				'default'		=>	false
			],
			'overlearning'	=>	[
				'type'			=>	'BOOLEAN',
				'null'			=>	false,
				'default'		=>	false
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

        $this->forge->addKey('card_id', true);

        $this->forge->createTable('card');
	}

	public function down()
	{
		$this->forge->dropTable('card');
		
	}
}
