<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pathway_model;
use App\academic_year_model;
use App\classes_model;
class classes_controller extends Controller
{
    public function choose_pathway_academic_year(){
        $arr_pathway = pathway_model::get_all();
        $arr_academic_year = academic_year_model::get_all();
        $arr_class = classes_model::get_all1();

        return view('classes/choose_pathway_academic_year',compact('arr_pathway','arr_academic_year','arr_class'));
    }
    public function get_class_by_pathway_academic_year(Request $rq){
        $check_form = $rq->get('check_form');
        $id_pathway = $rq->get('id_pathway');
        $id_academic_year = $rq->get('id_academic_year');
        $pathway = '';
        if($id_pathway != 0 && $id_academic_year == 0){
            $pathway = classes_model::get_class_by_pathway($id_pathway);
        }
        else if($id_academic_year != 0 && $id_pathway == 0){
            $pathway = classes_model::get_class_by_year($id_academic_year);
        }
        else if($id_academic_year != 0 && $id_pathway != 0){
            $pathway = classes_model::get_class_by_pathway_academic_year($id_pathway,$id_academic_year);
        }
        else{
            $pathway = classes_model::get_all1();
        }
        // dd($pathway);
        $string_option = "";
        if($check_form != 2){
            $string_option = "<option value='0'>----- Choose Class -----</option>";
        }
        
        // dd($pathway);
        if($pathway != ''){
            foreach ($pathway as $each){
                $link_update = route("classes_management.class_update",['class_id' => $each->class_id]);
                if($check_form == 2){
                    $string_option .= "
                        <tr>
                            <td>$each->class_id</td>
                            <td>$each->class_name</td>
                            <td>$each->pathway_name</td>
                            <td>$each->academic_year_name</td>
                            <td><a href='".$link_update."'>Edit</a></td>
                        </tr>
                    ";
                }
                else{
                    $string_option .= "
                        <option value='$each->class_id'>$each->class_name</option>
                    ";
                }
                
            }
        }
        echo ($string_option);
    }

    public function class_insert(){
        $arr_pathway = pathway_model::get_all();
        $arr_academic_year = academic_year_model::get_all();
        return view('classes/insert_class', compact('arr_pathway','arr_academic_year'));
    }
    
    public function class_insert_process(Request $rq){
        $this->validate($rq,[
            'pathway_id' => 'required:classes,pathway_id',
            'academic_year_id' => 'required:classes,academic_year_id',
            'class_name' => 'required|min:6|max:100|unique:classes,class_name',
        ],
        [
            'pathway_id.required'=>'Please choose Major again',
            'academic_year_id.required'=>'Please choose Academic year again',
            'class_name.required' => 'Please enter class name!',
            'class_name.min' => 'malformed class name!',
            'class_name.max' => 'malformed class name!',
            'class_name.unique' => 'malformed class name!',
        ]);

        $pathway = $rq->pathway_id;
        $academic_year = $rq->academic_year_id;
        $class = $rq->class_name;
        $check = classes_model::check($pathway, $academic_year,$class);
        if (count($check) != 0){
            return redirect()->back()->with('error', 'update failed');
        }
        else{
            $class = new classes_model();
            $class->academic_year_id = $rq->academic_year_id;
            $class->pathway_id = $rq->pathway_id;
            $class->class_name = $rq->class_name;
            $rq->session()->flash('status', 'Task was successful!');
            $class->class_insert_process();
            return redirect()->route('classes_management.choose_pathway_academic_year');
        }
        
    }

    public function class_update($class_id){
        $arr_academic_year = academic_year_model::get_all();
        $arr_pathway = pathway_model::get_all();
        $arr_class = classes_model::get_one($class_id);
        //dd($arr_class);
        return view('classes/update_class',compact('arr_class','arr_academic_year','arr_pathway'));
    }

    public function class_update_process($class_id, Request $rq){
        $this->validate($rq,[
            'pathway_id' => 'required:classes,pathway_id',
            'academic_year_id' => 'required:classes,academic_year_id',
            'class_name' => 'required|min:6|max:100|unique:classes,class_name',
        ],
        [
            'pathway_id.required'=>'Please choose Major again',
            'academic_year_id.required'=>'Please choose Academic year again',
            'class_name.required' => 'Please enter class name!',
            'class_name.min' => 'malformed class name!',
            'class_name.max' => 'malformed class name!',
            'class_name.unique' => 'malformed class name!',
        ]);

        $pathway = $rq->pathway_id;
        $academic_year = $rq->academic_year_id;
        $class = $rq->class_name;
        $check = classes_model::check($pathway, $academic_year, $class);
        if (count($check) != 0){
            return redirect()->back()->with('error', 'update failed');
        }
        else{
            $class = new classes_model();
            $class->class_id = $rq->class_id;
            $class->academic_year_id = $rq->academic_year_id;
            $class->pathway_id = $rq->pathway_id;
            $class->class_name = $rq->class_name;
            $rq->session()->flash('status', 'Task was successful!');
            $class->class_update_process();
            return redirect()->route('classes_management.choose_pathway_academic_year');
        }
    }
}
