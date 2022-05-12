<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!Department::where('department_name','Faculty')->count()){
            Department::create([
                'department_name' => 'Faculty',
            ]);
        }

        if(!Department::where('department_name','Marketing')->count()){
            Department::create([
                'department_name' => 'Marketing',
            ]);
        }

        $faker = Faker::create();
        Department::create([
            'department_name' => $faker->company,
        ]);
    }
}
