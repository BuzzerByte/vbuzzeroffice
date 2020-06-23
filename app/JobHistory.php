<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobHistory extends Model
{
    //
    protected $fillable = [
        'effective_from',
        'department_id',
        'title_id',
        'category_id',
        'status_id',
        'shift_id',
        'employee_id'
    ];

    public function user(){
        return $this->belongsTo('User');
    }

    public function department(){
        return $this->belongsTo('Department');
    }

    public function category(){
        return $this->belongsTo('JobCategory');
    }

    public static function CheckRecordExist($id){
        return JobHistory::where('employee_id',$id)->exists();
    }

    public static function departmentId($id){
        return JobHistory::where('employee_id',$id)->first()->department_id;
    }
}
