<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bpd extends Model
{
    use HasFactory;

    protected $table = 'tbl_bpds';
    protected $primaryKey = 'id_bpd';

    protected $fillable = [
        'id_department',
        'no_bpd',
        'objective',
        'created_by',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'id_department', 'id_department');
    }

    public function kpis()
    {
        return $this->hasMany(Kpi::class, 'id_bpd', 'id_bpd');
    }
}
