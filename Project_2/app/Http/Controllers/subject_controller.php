<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subject_model;
class subject_controller extends Controller
{
    public function subject_list(){
        $arr_subject = subject_model::get_all();
        return view('subject/list_subject',compact('arr_subject'));
    }

    public function subject_insert(){
        return view('subject/insert_subject');
    }

    public function subject_insert_process(Request $rq){
        $this->validate($rq,[
            'subject_name' => 'required|min:5|max:100|unique:subject,subject_name'
        ],
        [
            'subject_name.required'=>'Please enter Subject Name',
            'subject_name.min'=>'Subject Name absurd, Please enter again',
            'subject_name.max'=>'Subject Name absurd, Please enter again',
            'subject_name.unique'=>'Subject Name already exists'
        ]);
        $subject = new subject_model();
        $subject->subject_name = $rq->subject_name;
        $rq->session()->flash('status', 'Task was successful!');
        $subject->subject_insert_process();
        return redirect()->route('subject_management.subject_list');
    }

    public function subject_update($subject_id){
        $arr_subject = subject_model::get_one($subject_id);

        return view('subject/update_subject',compact('arr_subject'));
    }
    
    public function subject_update_process($subject_id,Request $rq){
        $this->validate($rq,[
            'subject_name' => 'required|min:5|max:100|unique:subject,subject_name'
        ],
        [
            'subject_name.required'=>'Please enter Subject Name',
            'subject_name.min'=>'Subject Name absurd, Please enter again',
            'subject_name.max'=>'Subject Name absurd, Please enter again',
            'subject_name.unique'=>'Subject Name already exists'
        ]);
        $subject = new subject_model();
        $subject->subject_id = $rq->subject_id;
        $subject->subject_name = $rq->subject_name;
        $rq->session()->flash('status', 'Task was successful!');
        $subject->subject_update_process();
        return redirect()->route('subject_management.subject_list');
    }
}
