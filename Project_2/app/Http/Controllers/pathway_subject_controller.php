<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pathway_model;
use App\subject_model;
use App\pathway_subject_model;
class pathway_subject_controller extends Controller
{
    public function ps_list(){
        $arr_pathway = pathway_model::get_all();
        $arr_subject = subject_model::get_all();
        return view('pathway_subject/list_ps', compact('arr_pathway','arr_subject'));
    }

    public function get_subjectps(Request $rq){
        $pathway_id = $rq->get('pathway_id');
      // dd($pathway_id);
        $pathway = '';
        if($pathway_id != 0 ){
            $pathway = pathway_subject_model::get_subject_by_pathway($pathway_id);
        }
        else if($pathway_id == 0 ){
            $pathway = subject_model::get_all();
        }
        // $pathway = pathway_subject_model::get_subject_by_pathway($pathway_id);
        $string_option = "";
            foreach ($pathway as $each){
                $string_option .= "
                    <tr>
                        <td>$each->subject_id</td>
                        <td>$each->subject_name</td>
                    </tr>
                ";      
            }
        echo ($string_option);
    }

    public function insert(){
        $arr_pathway = pathway_model::get_all();
        $arr_subject = subject_model::get_all();
        return view('pathway_subject/insert_ps', compact('arr_pathway','arr_subject'));
    }

    public function insert_process(Request $rq){

        $this->validate($rq,[
            'pathway_id' => 'required:pathway_subject,pathway_id',
            'subject_id' => 'required:pathway_subject,subject_id',
        ],
        [
            'pathway_id.required'=>'Please choose Major',
            'subject_id.required'=>'Please choose Subject',
        ]);

        $pathway = $rq->pathway_id;
        $subject = $rq->subject_id;
        $check = pathway_subject_model::check_ps($pathway, $subject);
        if (count($check) != 0){
            return redirect()->back()->with('error', 'Subject already exists');
        }
        else{
            $ps = new pathway_subject_model();
            $ps->pathway_id = $rq->pathway_id;
            $ps->subject_id = $rq->subject_id;
            $rq->session()->flash('status', 'Task was successful!');
            $ps->insert_process();
            return redirect()->route('pathway_subject_management.ps_list');

        }
        // $ps = new pathway_subject_model();
        // $ps->pathway_id = $rq->pathway_id;
        // $ps->subject_id = $rq->subject_id;
        // $rq->session()->flash('status', 'Task was successful!');
        // $ps->insert_process();
        // return redirect()->route('pathway_subject_management.ps_list');
    }

   
}
