<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Department::create([
            'dept_code' => 'IT',
            'dept_name' => 'Information Technology',
            'pin' => 123456,
            'created_by' => 1,
        ]);

        Department::create([
            'dept_code' => 'HR',
            'dept_name' => 'Human Resources',
            'pin' => 654321,
            'created_by' => 1,
        ]);

        $this->command->info('Test Departments created. IT PIN: 123456, HR PIN: 654321');
    }
}
