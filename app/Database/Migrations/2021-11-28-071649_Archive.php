<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Archive extends Migration
{
    public function up()
    {
          
        $this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true,],
            'name'       => ['type' => 'varchar', 'constraint' => '255'],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('category');

        $this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true,],
            'title'       => ['type' => 'varchar', 'constraint' => '255'],
            'document'    => ['type' => 'varchar', 'constraint' => '255'],
            'id_category'    => ['type' => 'varchar', 'constraint' => '255'],
            'created_at'  => ['type' => 'datetime'],
            'updated_at'  => ['type' => 'datetime'],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_category', 'category', 'id', '', 'CASCADE');
        $this->forge->createTable('archive');
    }

    public function down()
    {
        $this->forge->dropTable('archive');
        $this->forge->dropTable('category');
    }
}
