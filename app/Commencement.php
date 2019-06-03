<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commencement extends Model
{
    //
    protected $fillable = [
        'join_date',
        'probation_end',
        'dop',
        'employee_id'
    ];
}
