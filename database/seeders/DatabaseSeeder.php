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

        for ($i=0; $i < 6; $i++) {
            $this->call(DepartmentSeeder::class);
            $this->call(PositionSeeder::class);
        }

        for ($i=0; $i < 20; $i++) {
            $this->call(ApplicantSeeder::class);
            $this->call(EmployeeSeeder::class);
        }

        for ($i=0; $i < 10; $i++) {
            $this->call(MessageSeeder::class);
        }

        for ($i=0; $i < 15; $i++) {
            $this->call(CashadvanceSeeder::class);
            $this->call(BonusSeeder::class);
        }

        $this->call(AttendanceSeeder::class);
        $this->call(OvertimeSeeder::class);
        $this->call(PhilhealthSeeder::class);
        $this->call(PagibigSeeder::class);
        $this->call(DeductionSeeder::class);
        $this->call(ContributionsSeeder::class);
        $this->call(HolidaySeeder::class);
        $this->call(AssessmentSeeder::class);
        $this->call(LeaveApprovalSeeder::class);
        $this->call(HealthCheckSeeder::class);

    }
}

