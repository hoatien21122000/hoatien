<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\statistical_demol;
use App\pathway_model;
use App\academic_year_model;
use App\subject_model;
class statistical_controller extends Controller
{
    public function index(){
        $subject = statistical_demol::count_subject();
        $pathway = statistical_demol::count_pathway();
        $academic_year = statistical_demol::count_academic_year();
        $teacher = statistical_demol::count_teacher();
        $arr_pathway = pathway_model::get_all();
        $arr_academic_year = academic_year_model::get_all();
        $arr_subject = subject_model::get_all();
        return view('index', compact('subject','pathway','academic_year','teacher','arr_academic_year','arr_pathway','arr_subject'));
    }

    public function get_subject_by_pathway(Request $rq){
        $pathway_id = $rq->get('pathway_id');
        $pathway = statistical_demol::get_subject_by_pathway($pathway_id);
        $string_option = "<option value='0'>----- Choose Subject -----</option>";
            foreach ($pathway as $each){
                $string_option .= "
                    <option value='$each->subject_id'>$each->subject_name</option>
                ";      
            }
        
        echo ($string_option);
    }

    public function get_number_student(Request $rq){
        // Dd($rq->all());
        $pathway_id = $rq->get('pathway_id');
        $academic_year_id = $rq->get('academic_year_id');
        $subject_id = $rq->get('subject_id');
        $array = statistical_demol::get_number_student($pathway_id,$academic_year_id,$subject_id);
        $array_class = array_pluck($array,'class_name');
		$array_number_of_students_passing_subject = array_pluck($array,'number_of_students_passing_subject');
		$array_number_of_students_dont_pass_subject = array_pluck($array,'number_of_students_dont_passing_subject');
		return compact('array_class','array_number_of_students_passing_subject','array_number_of_students_dont_pass_subject');
    }
}