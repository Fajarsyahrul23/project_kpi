<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterBpd extends Model
{
    protected $table = 'tbl_master_bpds';

    protected $fillable = [
        'no_bpd',
        'objective',
    ];
}
