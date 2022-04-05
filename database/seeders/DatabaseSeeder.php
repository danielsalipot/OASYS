<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ManagerSeeder::class);
        $this->call(PayrollSeeder::class);
        $this->call(StaffSeeder::class);

        for ($i=0; $i < 10; $i++) {
            $this->call(ApplicantSeeder::class);
            $this->call(EmployeeSeeder::class);
        }

        for ($i=0; $i < 20; $i++) {
            $this->call(NotifSeeder::class);
        }

        for ($i=0; $i < 5; $i++) {
            $this->call(CashadvanceSeeder::class);
        }

        $this->call(AttendanceSeeder::class);
        $this->call(OvertimeSeeder::class);
        $this->call(DeductionSeeder::class);
    }
}
