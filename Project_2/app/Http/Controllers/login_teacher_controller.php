<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\login_teacher_model;
class login_teacher_controller extends Controller
{
    public function login_teacher(){
        return view('login_teacher');
    }
    public function login_teacher_process(Request $rq){
        $email = $rq->get('email');
        $password = $rq->get('password');
        $teacher = new login_teacher_model();
        $teacher->email = $email;
        $teacher->password = $password;
        $array = $teacher->get_one();

        if(count($array)==1){
            $rq->session()->put('email',$array[0]->email);
            $rq->session()->put('teacher_name',$array[0]->teacher_name);

            return redirect()->route('login_controller.index');
        }
        else{
            return redirect()->route('login_teacher')->with('message_error','Thông tin không chính xác hãy đăng nhập lại');
        }
         
    }
    public function index() {
        return view('index'); 
     }
     public function logout_teacher(Request $rq){
        $rq->session()->flush();
        return redirect()->route('login_teacher');
    }
}
