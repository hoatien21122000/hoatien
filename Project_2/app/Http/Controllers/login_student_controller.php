<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\login_student_model;
class login_student_controller extends Controller
{
    public function login_student()
    {
    	return view('login_student');
    }

    public function login_student_process(Request $rq)
    {
    	$email = $rq->email;
    	$password = $rq->password;
    	$student = login_student_model::login_student_process($email,$password);
    	if(count($student)== 1) 
        {
            $rq->session()->put('student_id',$student[0]->student_id);
            $rq->session()->put('email_student',$student[0]->email);
            $rq->session()->put('student_name',$student[0]->student_name);
            return redirect()->route('student_login.hello_student');
        }
        else
        {
            return redirect()->route('login_student')->with('success_student','User account or password is incorrect!');

        }
    	
    }

    public function hello_student()
    {
    	return view('main_page_student');
    }

    public function logout_student(Request $rq)
    {
        $rq->session()->flush();
        return redirect()->route('login_student');
    }
}
