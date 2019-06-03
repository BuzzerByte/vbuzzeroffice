<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeSalary $employeeSalary)
    {
        $update = EmployeeSalary::where('id',$employeeSalary->id)->update([
            'type'=>$request->type,
            'pay_grade'=>$request->grade_id,
            'comment'=>$request->comment,
            'basic_payment'=>$request->basic_payment,
            'car_allowance'=>$request->car_allowance,
            'medical_allowance'=>$request->medical_allowance,
            'living_allowance'=>$request->living_allowance,
            'house_rent'=>$request->house_rent,
            'gratuity'=>$request->gratuity,
            'pension'=>$request->pension,
            'insurance'=>$request->insurance,
            'total_deduction'=>$request->total_deduction,
            'total_payable'=>$request->total_payable,
            'cost_to_company'=>$request->total_cost_company,
            'hourly_salary'=>$request->hourly_salary
        ]);
        return redirect()->action('UserController@employeeSalaries',['id'=>$employeeSalary->employee_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        //
    }
}
