<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Position extends Seeder
{
    public function run()
    {
        $data = 
        [
            [
                'code' => 'N41',
                'position'    => 'Assistant Registrar',
                'created_at' => Time::now()
            ],
            [
                'code' => 'N29',
                'position'    => 'Assistant Administrative',
                'created_at' => Time::now()
            ],
            [
                'code' => 'N17',
                'position'    => 'Cleark',
                'created_at' => Time::now()
            ],
            [
                'code' => 'F41',
                'position'    => 'IT Officer',
                'created_at' => Time::now()
            ],
            [
                'code' => 'FA29',
                'position'    => 'Assistant IT Officer',
                'created_at' => Time::now()
            ],
            [
                'code' => 'FA17',
                'position'    => 'Technician',
                'created_at' => Time::now()
            ],
        ];

        $this->db->table('position')->insertBatch($data);
    }
}
