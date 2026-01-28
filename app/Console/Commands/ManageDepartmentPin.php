<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManageDepartmentPin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'department:pin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate or reset Department PINs securely';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('--- Department PIN Management ---');

        $deptCode = $this->ask('Enter Department Code');
        if (empty($deptCode)) {
            $this->error('Department Code is required.');
            return;
        }

        $pin = $this->ask('Enter New PIN (min 6 digits, numeric only)');

        // Validate PIN
        $validator = Validator::make(['pin' => $pin], [
            'pin' => 'required|numeric|min_digits:6',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        $department = Department::where('dept_code', $deptCode)->first();

        if ($department) {
            $this->info("Department found: {$department->dept_name}. Resetting PIN...");
        } else {
            $deptName = $this->ask('Department not found. Enter New Department Name');
            if (empty($deptName)) {
                $this->error('Department Name is required for new entries.');
                return;
            }

            $department = new Department();
            $department->dept_code = $deptCode;
            $department->dept_name = $deptName;
            $department->created_by = 1; // Default admin ID or however you track creators
            $this->info("Creating new department: {$deptName}...");
        }

        // Securely hash the PIN
        $department->pin = Hash::make($pin);
        $department->save();

        $this->info('Success! PIN has been securely stored.');
    }
}
