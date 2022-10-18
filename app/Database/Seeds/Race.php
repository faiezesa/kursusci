<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Race extends Seeder
{
    public function run()
    {
        $data = 
        [
            [
                'code' => 'M',
                'race'    => 'Malay',
                'created_at' => Time::now()
            ],
            [
                'code' => 'I',
                'race'    => 'Indian',
                'created_at' => Time::now()
            ],
            [
                'code' => 'C',
                'race'    => 'Chinese',
                'created_at' => Time::now()
            ],
            [
                'code' => 'S',
                'race'    => 'Sikh',
                'created_at' => Time::now()
            ],
            [
                'code' => 'K',
                'race'    => 'Sarawakian',
                'created_at' => Time::now()
            ],
            [
                'code' => 'H',
                'race'    => 'Sabahan',
                'created_at' => Time::now()
            ],
            [
                'code' => 'O',
                'race'    => 'Others',
                'created_at' => Time::now()
            ]
        ];

        $this->db->table('race')->insertBatch($data);
    }
}
