<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Salary extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'salary' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ],
            'emp_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true,
            ],
            'from_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'to_date' => [
                'type' => 'DATE',
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
        $this->forge->createTable('salary');
    }

    public function down()
    {
        $this->forge->dropTable('salary');
    }
}
