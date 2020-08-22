<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\academic_year_model;
use DB;
class academic_year_controller extends Controller
{
    public function academic_year_list(){
        $arr_academic_year = academic_year_model::get_all();
        return view('academic_year/list_academic_year',compact('arr_academic_year'));
    }
    public function academic_year_insert(){
        return view('academic_year/insert_academic_year');
    }
    public function academic_year_insert_process(Request $rq){

        $this->validate($rq,[
            'academic_year_name' => 'required|min:2|max:50|unique:academic_year,academic_year_name'
        ],
        [
            'academic_year_name.required'=>'Please enter Academic year name',
            'academic_year_name.min'=>'please enter again, major name is not correct format',
            'academic_year_name.max'=>'please enter again, Major name is not correct format',
            'academic_year_name.unique'=>'please enter again, This Major name already exists'
        ]);

        $academic_year = new academic_year_model();
        $academic_year->academic_year_name = $rq->academic_year_name;
        $rq->session()->flash('status', 'Task was successful!');
        $academic_year->academic_year_insert_process();
        return redirect()->route('academic_year_management.academic_year_list');
    }

    public function academic_year_update($academic_year_id){
        $arr_academic_year = academic_year_model::get_one($academic_year_id);
        return view('academic_year/update_academic_year',compact('arr_academic_year'));
    }

    public function academic_year_update_process($academic_year_id,Request $rq){

        $this->validate($rq,[
            'academic_year_name' => 'required|min:2|max:50:academic_year,academic_year_name'
        ],
        [
            'academic_year_name.required'=>'Please enter Academic year name',
            'academic_year_name.min'=>'please enter again, Major name is not correct format',
            'academic_year_name.max'=>'please enter again, Major name is not correct format'
        ]);

        $academic_year = new academic_year_model();
        $academic_year->academic_year_id = $rq->academic_year_id;
        $academic_year->academic_year_name = $rq->academic_year_name;
        $rq->session()->flash('status', 'Task was successful!');
        $academic_year->academic_year_update_process();
        return redirect()->route('academic_year_management.academic_year_list');
    }

}
