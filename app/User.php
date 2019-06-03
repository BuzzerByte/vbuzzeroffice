<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role',
        'facebook_id', 
        'google_id',
        'github_id',
        'skin',
        'f_name',
        'l_name',
        'dob',
        'marital_status',
        'country',
        'blood_group',
        'id_number',
        'religious',
        'gender',
        'terminate_status',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function jobHistories($id){
        return JobHistory::select('department_id')->where('employee_id',$id)->first();
    }

    public function department($id){
        $department = JobHistory::where('employee_id',$id)->exists();
        if($department){
            $deparment_id = JobHistory::where('employee_id',$id)->first()->department_id;
            return Department::where('id',$deparment_id)->first()->name;
        }else{
            return "No Job History Found";
        }
    }

    public function jobTitle($id){
        $jobTitle = JobHistory::where('employee_id',$id)->exists();
        if($jobTitle){
            $titleId = JobHistory::where('employee_id',$id)->first()->title_id;
            return JobTitle::where('id',$titleId)->first()->title;
        }else{
            return "No Job History found";
        }
    }

    public function jobCategory($id){
        $jobCategory = JobHistory::where('employee_id',$id)->exists();
        if($jobCategory){
            $jobCategoryId = JobHistory::where('employee_id',$id)->first()->category_id;
            return JobCategory::where('id',$jobCategoryId)->first()->category;
        }else{
            return "No Job History found";
        }
    }

    public function workShift($id){
        $workShift = JobHistory::where('employee_id',$id)->exists();
        if($workShift){
            $workShiftId = JobHistory::where('employee_id',$id)->first()->shift_id;
            return WorkShift::where('id',$workShiftId)->first()->name;
        }else{
            return "No Job History found";
        }
    }
}
