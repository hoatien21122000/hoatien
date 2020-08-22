<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\teacher_model;
class teacher_controller extends Controller
{
    public function teacher_list(){
        $arr_teacher = teacher_model::get_all();
        return view('teacher/list_teacher',compact('arr_teacher'));
    }

    public function teacher_insert(){
        return view('teacher/insert_teacher');
    }

    public function teacher_insert_process(Request $rq){

        $this->validate($rq,[
            'teacher_name' => 'required|min:5|max:50:teacher,teacher_name',
            'address' => 'required|min:5:teacher,address',
            'teacher_phone_number' => 'required|regex:/(0)[0-9]{9}/',
            'sex' => 'required:teacher,sex',
            'email' => 'required|unique:student,email',
            'password' => 'required|min:6:student,password'
        ],
        [
            'teacher_name.required'=>'Please enter Teacher Name',
            'teacher_name.min'=>'Teacher Name absurd, Please enter again',
            'teacher_name.max'=>'Teacher Name absurd, Please enter again',
            'teacher_name.alpha'=>'Please enter Teacher Name again',
            'address.required'=>'Please enter Address',
            'address.min'=>'Please enter Address again',
            'teacher_phone_number.required'=> 'Please enter Telephone Number',
            'sex.required'=>'Please choose sex',
            'teacher_phone_number.regex' =>'Phone Number absurd, Please enter again',
            'email.required'=> 'Please enter Email',
            'email.unique' => 'Email absurd, Please enter again',
            'password.required'=> 'Please enter password',
            'password.min' => 'password absurd (>6), Please enter again'
        ]);

        $teacher = new teacher_model();
        $teacher->teacher_name          = $rq->teacher_name;
        $teacher->teacher_phone_number  = $rq->teacher_phone_number;
        $teacher->sex                   = $rq->sex;
        $teacher->address               = $rq->address;
        $teacher->date_of_birth         = $rq->date_of_birth;
        $teacher->email                 = $rq->email;
        $teacher->password              = $rq->password;
        $rq->session()->flash('status', 'Task was successful!');
        $teacher->teacher_insert_process();
        return redirect()->route('teacher_management.teacher_list');
    }

    public function teacher_update($email){
        $this->validate($rq,[
            'teacher_name' => 'required|min:5|max:50:teacher,teacher_name',
            'address' => 'required|min:5:teacher,address',
            'teacher_phone_number' => 'required|regex:/(0)[0-9]{9}/',
            'sex' => 'required:teacher,sex',
            'email' => 'required|unique:student,email',
            'password' => 'required|min:6:student,password'
        ],
        [
            'teacher_name.required'=>'Please enter Teacher Name',
            'teacher_name.min'=>'Teacher Name absurd, Please enter again',
            'teacher_name.max'=>'Teacher Name absurd, Please enter again',
            'teacher_name.alpha'=>'Please enter Teacher Name again',
            'address.required'=>'Please enter Address',
            'address.min'=>'Please enter Address again',
            'teacher_phone_number.required'=> 'Please enter Telephone Number',
            'sex.required'=>'Please choose sex',
            'teacher_phone_number.regex' =>'Phone Number absurd, Please enter again',
            'email.required'=> 'Please enter Email',
            'email.unique' => 'Email absurd, Please enter again',
            'password.required'=> 'Please enter password',
            'password.min' => 'password absurd (>6), Please enter again'
        ]);
        $arr_teacher = teacher_model::get_one($email);
        return view('teacher/update_teacher',compact('arr_teacher'));
    }

    public function teacher_update_process($email,Request $rq){
        $teacher = new teacher_model();
        $teacher->teacher_name          = $rq->teacher_name;
        $teacher->teacher_phone_number  = $rq->teacher_phone_number;
        $teacher->sex                   = $rq->sex;
        $teacher->address               = $rq->address;
        $teacher->date_of_birth         = $rq->date_of_birth;
        $teacher->email                 = $rq->email;
        $teacher->password              = $rq->password;
        $rq->session()->flash('status', 'Task was successful!');
        $teacher->teacher_update_process();
        return redirect()->route('teacher_management.teacher_list');
    }
}
