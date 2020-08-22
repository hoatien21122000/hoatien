<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\student_view_model;
use Validator;
use RealRashid\SweetAlert\Facades\Alert;
class student_view_controller extends Controller
{
    public function view_information()
    {
        $student_id=session()->get('student_id');
        $student = student_view_model::get_one($student_id);
        return view('student_view/information', compact('student'));
    }

    public function change_information(Request $rq)
    {
        $validator = Validator::make($rq->all(),
        [
        'address' => 'required|max:200',
        'student_phone_number'=>'required|regex:/(0)[0-9]{9}/',
        'email'=>'required|email',
        ],
        [
        'address.required'=>'Address must not be blank',
        'address.max'=>'Address must not be longer than 200 characters',
        'student_phone_number.required'=>'Phone number must not be blank',
        'student_phone_number.regex'=>'The phone number is in the right format and includes 10 numbers',
        'email.required'=>'Email must not be blank',
        'email.email'=>'Email is in the right format',
        ]
        );
        if($validator->fails())
        {
            return redirect()->back()
            ->withErrors($validator);
        }
        else
        {
        $student = new student_view_model();
        $student->student_id = $rq->student_id;
        $student->address = $rq->address;
        $student->student_phone_number = $rq->student_phone_number;
        $student->email = $rq->email;
        alert()->success('Congratulation','Successfully updated');
        $student->change_information_process();
        return redirect()->back();

        }
    }

    public function change_password()
    {
        $student_id=session()->get('student_id');
        $password = student_view_model::get_password($student_id);
        return view('student_view/change_password',compact('password'));
    }

    public function change_password_process(Request $rq,$student_id)
    {
        $validator = Validator::make($rq->all(),
        [
        'old_password'=>'required',
        'password'=>'required|unique:student|min:6',
        'password_confirm'=>'required|same:password',
        ],
        [
        'old_password.required'=>'Note: Must be the same old password',
        'password.required'=>'Password must not be blank',
        'password.unique'=>'Password must be unique',
        'password.min'=>'Password  must not be shorter than 6 characters',
        'password_confirm.required'=>'New Password must not be blank',
        'password_confirm.same'=>'Retype new password incorrectly',

        ]
        );
        $old_password = student_view_model::get_password_by_student_id($student_id);
        $old_password2=$rq->old_password; 
        if($validator->fails() || $old_password[0]->password != $old_password2)
        {
            return redirect()->back()
            ->withErrors($validator);
        }
        else
        {
            $new_password = new student_view_model();
            $new_password->student_id = $rq->student_id;
            $new_password->password = $rq->password;
            alert()->success('Congratulation','Successfully updated');
            $new_password->change_password_process();
            return redirect()->back();
        }
       
    }
}
