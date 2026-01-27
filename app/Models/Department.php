<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'tbl_department';
    protected $primaryKey = 'id_department';

    protected $fillable = [
        'dept_code',
        'dept_name',
        'pin',
        'created_by',
    ];

    public function bpds()
    {
        return $this->hasMany(Bpd::class, 'id_department', 'id_department');
    }
}
