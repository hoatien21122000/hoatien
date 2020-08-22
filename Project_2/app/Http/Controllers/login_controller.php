<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\login_model;
class login_controller extends Controller
{
    public function login(){
        return view('login');
    }
    public function login_process(Request $rq){
        $email = $rq->get('email');
        $password = $rq->get('password');
        $registrar = new login_model();
        $registrar->email = $email;
        $registrar->password = $password;
        $array = $registrar->get_one();

        if(count($array)==1){
            $rq->session()->put('email_registrar',$array[0]->email);
            $rq->session()->put('registrar_name',$array[0]->registrar_name);

            return redirect()->route('login_controller.index');
        }
        else{
            return redirect()->route('login')->with('message_error','Thông tin không chính xác hãy đăng nhập lại');
        }
         
    }
    public function index() {
        return view('index'); 
     }
     public function logout(Request $rq){
        $rq->session()->flush();
        return redirect()->route('login');
    }
}
