<?php

namespace Database\Seeders;

use App\Models\leave_approval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class LeaveApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1; $i < 6; $i++) {
            leave_approval::create([
                'employee_id' => $i,
                'start_date' => '2022-09-01',
                'end_date' => '2022-09-05',
                'title' => 'Hello World',
                'detail' => $faker->realText($maxNbChars = 200, $indexSize = 2),
            ]);
        }
    }
}
