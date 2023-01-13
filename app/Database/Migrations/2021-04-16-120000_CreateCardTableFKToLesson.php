<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ForeignKeyForCardTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('card', [
                    'lesson_id'       =>  [
                                'type'          =>  'INT',
                                'constraint'    =>  7,
                                'unsigned'      =>  true
                            ]
                        ]);
        

        $sql = "ALTER TABLE card
                ADD CONSTRAINT card_lesson_id_fk
                FOREIGN KEY (lesson_id) REFERENCES lesson(lesson_id)
                ON DELETE CASCADE ON  UPDATE CASCADE";

        $this->db->simpleQuery($sql);
    }
    //---------------------------------------------------------------------------
    public function down()
    {
        $this->forge->dropForeignKey('card','card_lesson_id_fk');
        $this->forge->dropColumn('card', 'lesson_id');
    }


}