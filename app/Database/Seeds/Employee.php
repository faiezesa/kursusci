<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Employee extends Seeder
{
    public function run()
    {
        $this->db->table('employee')->truncate();
        $faker = \Faker\Factory::create('ms_MY');
        for($i = 0; $i < 50; $i++){
            $data = 
            [
                'name' => $faker->name,
                'icno'    => $faker->myKadNumber($hyphen = false),
                'created_at' => Time::now(),
                'email' => $faker->email,
                'phone' => $faker->voipNumber($countryCodePrefix = false, $formatting = false),
                'gender' => $faker->randomElement(['F', 'M']),
                'race' => $faker->randomElement(['M', 'I', 'C', 'K', 'S']),
                'religion' => $faker->randomElement(['B', 'I', 'C']),
                'birth_date' => $faker->date('Y_m_d'),
                'birth_place' => $faker->state,
            ];
            $this->db->table('employee')->insert($data);
        }

    }
}
