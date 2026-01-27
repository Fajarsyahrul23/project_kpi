<?php

namespace Database\Seeders;

use App\Models\MasterBpd;
use Illuminate\Database\Seeder;

class MasterBpdSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['no_bpd' => '1.1', 'objective' => 'Fatal Incident'],
            ['no_bpd' => '1.2', 'objective' => 'Lost Time Injury (LTI)'],
            ['no_bpd' => '1.3', 'objective' => 'Total Recordable Injury Frequency Rate (TRIFR)'],
            ['no_bpd' => '2.1', 'objective' => 'Operational Efficiency'],
            ['no_bpd' => '2.2', 'objective' => 'Cost Reduction'],
        ];

        foreach ($data as $item) {
            MasterBpd::updateOrCreate(
                ['no_bpd' => $item['no_bpd']],
                ['objective' => $item['objective']]
            );
        }
    }
}
