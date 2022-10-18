<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Religion extends Seeder
{
    public function run()
    {
        $data = 
        [
            [
                'code' => 'I',
                'religion'    => 'Islam',
                'created_at' => Time::now()
            ],
            [
                'code' => 'B',
                'religion'    => 'Buddha',
                'created_at' => Time::now()
            ],
            [
                'code' => 'C',
                'religion'    => 'Cristian',
                'created_at' => Time::now()
            ],
            [
                'code' => 'O',
                'religion'    => 'Others',
                'created_at' => Time::now()
            ]
        ];

        $this->db->table('religion')->insertBatch($data);
    }
}
