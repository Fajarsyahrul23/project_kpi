<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;

    protected $table = 'tbl_kpis';
    protected $primaryKey = 'id_kpi';

    protected $fillable = [
        'id_bpd',
        'dept_code',
        'definition',
        'periode',
        'target',
        'actual', 
        'com_target',
        'com_actual',
        'note',
        'created_by',
    ];

    protected $casts = [
        'periode' => 'date',
        'com_target' => 'float',
        'com_actual' => 'float',
    ];

    public function bpd()
    {
        return $this->belongsTo(Bpd::class, 'id_bpd', 'id_bpd');
    }


public function getComActualPercentAttribute()
{
    return $this->com_actual !== null
        ? rtrim(rtrim(number_format($this->com_actual, 2), '0'), '.') . '%'
        : '-';
}

public function getComTargetPercentAttribute()
{
    return $this->com_target !== null
        ? rtrim(rtrim(number_format($this->com_target, 2), '0'), '.') . '%'
        : '-';
}
}