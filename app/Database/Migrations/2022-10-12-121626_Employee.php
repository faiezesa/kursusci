<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employee extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'icno' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => true,
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => '5',
                'null' => true,
            ],
            'race' => [
                'type' => 'VARCHAR',
                'constraint' => '5',
                'null' => true,
            ],
            'religion' => [
                'type' => 'VARCHAR',
                'constraint' => '5',
                'null' => true,
            ],
            'birth_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'birth_place' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('employee');

        
    }

    public function down()
    {
        $this->forge->dropTable('employee');
    }
}
