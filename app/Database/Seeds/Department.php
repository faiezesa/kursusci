<?php

namespace App\Database\Seeds;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class Department extends Seeder
{
    public function run()
    {
        $data = 
        [
            [
                'name'    => 'Admin',
                'created_at' => Time::now()
            ],
            [
                'name'    => 'Software',
                'created_at' => Time::now()
            ],
            [
                'name'    => 'Networking',
                'created_at' => Time::now()
            ],
            [
                'name'    => 'Maintenance',
                'created_at' => Time::now()
            ],
            
        ];

        $this->db->table('department')->insertBatch($data);
    }
}
