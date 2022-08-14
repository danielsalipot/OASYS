<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\EmployeeDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = EmployeeDetail::all("employee_id");
        $types = ["attendance","performance","character","cooperation"];
        $faker = Faker::create();

        for ($h=0; $h < 6; $h++) {
            foreach ($employee as $key => $value) {
                $year = $faker->date('Y');
                for ($j=1; $j <= 4; $j++) {
                    for ($i=0; $i < 4; $i++) {
                        Assessment::create([
                            'employee_id' => $value->employee_id,
                            'assessment_type' => $types[$i],
                            'score' => rand(0,100),
                            'feedback' => $faker->realText(500),
                            'year' => $year,
                            'quarter'=> $j,
                            'start_date' => $faker->date('Y-m-d'),
                            'end_date'=> $faker->date('Y-m-d')
                        ]);
                    }
                }
            }
        }
    }
}
