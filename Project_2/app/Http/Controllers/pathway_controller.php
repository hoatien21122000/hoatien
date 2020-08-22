<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pathway_model;
Use Alert;
class pathway_controller extends Controller
{
    public function pathway_list(){
        $arr_pathway = pathway_model::get_all();
        return view('pathway/list_pathway',compact('arr_pathway'));
    }

    public function pathway_insert(){
        return view('pathway/insert_pathway');
    }

    public function pathway_insert_process(Request $rq){
        $this->validate($rq,[
            'pathway_name' => 'required|min:5|max:100|unique:pathway,pathway_name'
        ],
        [
            'pathway_name.required'=>'Please enter Major name',
            'pathway_name.min'=>'please enter again, major name is not correct format',
            'pathway_name.max'=>'please enter again, major name is not correct format',
            'pathway_name.unique'=>'please enter again, This Major name already exists',
            'pathway_name.alpha'=>'please enter again'
        ]);
        $pathway = new pathway_model();
        $pathway->pathway_name = $rq->pathway_name;
        $rq->session()->flash('status', 'Task was successful!');
        $pathway->pathway_insert_process();
        return redirect()->route('pathway_management.pathway_list');
        //return redirect()->route('pathway_management.pathway_list');
    }

    public function pathway_update($pathway_id){
        $arr_pathway = pathway_model::get_one($pathway_id);
        return view('pathway/update_pathway',compact('arr_pathway'));
    }
    
    public function pathway_update_process($pathway_id,Request $rq){
        $this->validate($rq,[
            'pathway_name' => 'required|alpha|min:5|max:100:pathway,pathway_name'
        ],
        [
            'pathway_name.required'=>'Please enter Major name',
            'pathway_name.min'=>'Major name is not correct format',
            'pathway_name.max'=>'Major name is not correct format',
            'pathway_name.alpha'=>'please enter again'
        ]);
        $pathway = new pathway_model();
        $pathway->pathway_id = $rq->pathway_id;
        $pathway->pathway_name = $rq->pathway_name;
        $rq->session()->flash('status', 'Task was successful!');
        $pathway->pathway_update_process();
        return redirect()->route('pathway_management.pathway_list');
    }

}
