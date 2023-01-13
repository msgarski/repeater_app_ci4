<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ForeignKeyForCardTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('card', [
                    'last_repeat'       =>  [
                            'type'     => 'DATETIME',
                            'null'     => true,
                            'default'  => null
                    ],
                    'next_repeat'       =>  [
                            'type'     => 'DATETIME',
                            'null'     => true,
                            'default'  => null
                    ],
                    'card_awareness'       =>  [
                            'type'          =>  'TINYINT',
                            'constraint'    =>  1,
                            'unsigned'      =>  true,
                            'default'       =>  null
                    ],
                    'total_repetitions'       =>  [
                            'type'          =>  'TINYINT',
                            'constraint'    =>  2,
                            'unsigned'      =>  true,
                            'default'       =>  null
                    ],
                    'success_repeatitions'       =>  [
                            'type'          =>  'TINYINT',
                            'constraint'    =>  2,
                            'unsigned'      =>  true,
                            'default'       =>  null
                    ],
                    'priority'                  =>  [
                            'type'          =>  'BOOLEAN',
                            'null'          =>  false,
                            'default'       =>  false
                    ],
                    'oneday_repeat'              =>      [
                                'type'          =>      'BOOLEAN',
                                'null'          =>      false,
                                'default'       =>      false
                    ],
                    'reverse_ready'              =>      [
                        'type'          =>      'BOOLEAN',
                        'null'          =>      false,
                        'default'       =>      false
                ],
                    'longest_period'       =>  [
                            'type'          =>  'INT',
                            'constraint'    =>  4,
                            'unsigned'      =>  true,
                            'default'       =>  null
                    ],
                    'multiplier'       =>  [
                            'type'          =>  'FLOAT(1,1)',
                            'unsigned'      =>  true,
                            'default'       =>  null
                    ]
        ]);

    }
    public function down()
    {
        $this->forge->dropColumn('card','last_repeat, 
                                        next_repeat, 
                                        card_awareness,
                                        total_repetitions,
                                        success_repeatitions,
                                        priority,
                                        longest_period,
                                        oneday_repeat,
                                        reverse_ready,
                                        multiplier');
    }


}