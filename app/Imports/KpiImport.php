<?php

namespace App\Imports;

use App\Models\Kpi;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class KpiImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    protected $id_bpd;

    public function __construct($id_bpd)
    {
        $this->id_bpd = $id_bpd;
    }

    public function model(array $row)
    {
        return new Kpi([
            'id_bpd' => $this->id_bpd,
            'definition' => $row['definition'] ?? null,

            'periode' => isset($row['periode'])
                ? $this->parseDate($row['periode'])
                : null,
'target' => $row['target'] ?? null,
            'actual' => $row['actual'] ?? null,
            'com_target' => $row['com_target'] ?? null,
            'com_actual' => $row['com_actual'] ?? null, 
            
            'note' => $row['note'] ?? null,
            'created_by' => Session::get('department_id'),
        ]);
    }


    private function parseDate($value)
{
    if (empty($value)) {
        return null;
    }

    // Excel numeric date (xlsx)
    if (is_numeric($value)) {
        return Date::excelToDateTimeObject($value)->format('Y-m-d');
    }

    // CSV Indonesia: 31/01/2026
    if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $value)) {
        return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    // CSV / Excel English: 2026-01-31 atau Jan 31 2026
    try {
        return Carbon::parse($value)->format('Y-m-d');
    } catch (\Exception $e) {
        return null;
    }
}

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}