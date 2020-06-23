<?php

namespace App\Http\Controllers;

use App\Dependent;
use Illuminate\Http\Request;

class DependentController extends Controller
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
        $store = EmployeeDependent::create([
            'name'=>$request->name,
            'relationship'=>$request->relationship,
            'dob'=>$request->date_of_birth,
            'employee_id'=>$request->employee_id
        ]);
        return redirect()->action('UserController@employeeDependents',['id'=>$request->employee_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dependent  $dependent
     * @return \Illuminate\Http\Response
     */
    public function show(Dependent $dependent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dependent  $dependent
     * @return \Illuminate\Http\Response
     */
    public function edit(Dependent $dependent)
    {
        //
        return response()->json($employeeDependent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dependent  $dependent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dependent $dependent)
    {
        //
        $update = EmployeeDependent::where('id',$employeeDependent->id)->update([
            'name'=>$request->name,
            'relationship'=>$request->relationship,
            'dob'=>$request->date_of_birth
        ]);
        return redirect()->action('UserController@employeeDependents',['id'=>$employeeDependent->employee_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dependent  $dependent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dependent $dependent)
    {
        //
    }

    public function delete(Request $request){
        // return response()->json($request);
        $dependentId_arr = $request->dependentId;
        if($dependentId_arr!=null){
            foreach($dependentId_arr as $id){
                $dependent = EmployeeDependent::find((int)$id);
                $dependent->delete();
            }
            return redirect()->action('UserController@employeeDependents',['id'=>$request->employee_id]);
        
        }else{
            return redirect()->action('UserController@employeeDependents',['id'=>$request->employee_id]);
        }
    }
}
