<?php

namespace App\Database\Seeds;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class Deptassign extends Seeder
{
    public function run()
    {
        $this->db->table('dept_assign')->truncate();
        $faker = \Faker\Factory::create('ms_MY');
        for($i = 0; $i < 50; $i++){
            $data = 
            [
                'emp_id' => $i+1,
                'dept_id' => $faker->randomElement(['1', '2', '3', '4']),
                'pos_id' => $faker->randomElement(['1', '2', '3', '4', '5', '6']),
                'created_at' => Time::now(),
                'from_date' => $faker->date('Y_m_d'),
            ];
            $this->db->table('dept_assign')->insert($data);
        }
    }
}
