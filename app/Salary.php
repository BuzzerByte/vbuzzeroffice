<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //
    protected $fillable = [
        'type',
        'pay_grade',
        'comment',
        'basic_payment',
        'car_allowance',
        'medical_allowance',
        'living_allowance',
        'house_rent',
        'gratuity',
        'pension',
        'insurance',
        'total_deduction',
        'total_payable',
        'cost_to_company',
        'employee_id'
    ];

    public function userId($id){
        $userId = EmployeeSalary::where('id',$id)->first()->employee_id;
        return User::where('employee_id',$userId)->first()->id_number;
    }

    public function userName($id){
        $userId = EmployeeSalary::where('id',$id)->first()->employee_id;
        return User::where('employee_id',$userId)->first()->name;
    }

    public function jobTitle($id){
        $userId = EmployeeSalary::where('id',$id)->first()->employee_id;
        $titleId = JobHistory::where('employee_id',$userId)->first()->title_id;
        return JobTitle::where('id',$titleId)->title;
    }
}
