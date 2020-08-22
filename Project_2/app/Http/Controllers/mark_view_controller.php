<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\subject_model;
use\App\classes_model;
use\App\student_model;
use\App\mark_view_model;
class mark_view_controller extends Controller
{
    public function mark_view(){
        $arr_class = classes_model::get_all();
        // $arr_subject = subject_model::get_all();

        return view('mark',compact('arr_class'));
    }
    public function get_subject1(Request $rq){
        $class_id = $rq->get('class_id');
        $subject = subject_model::get_subject($class_id);
        
        return $subject;
    }

    public function list_mark(Request $rq){
        $class_id = $rq->get('class_id');
        $subject_id = $rq->get('subject_id');

        $arr_class = classes_model::get_all();
        $arr_subject = subject_model::get_subject($class_id);
        

        $arr_student = student_model::get_student_by_class($class_id);
        $arr_mark = mark_view_model::get_mark_by_class_and_subject($class_id,$subject_id);

        $array = [];
        foreach ($arr_mark as $each){
            $student_id = $each->student_id;
            $exam_times = $each->exam_times;
            $array[$student_id][$exam_times] = $each->mark;
        }
        $max_time =  mark_view_model::get_max_exam_times_by_class_and_subject($class_id,$subject_id) + 1;

        return view('mark_view',[
            'arr_class' => $arr_class,
            'arr_subject' => $arr_subject,
            'class_id' => $class_id,
            'subject_id' => $subject_id,
            'arr_student' => $arr_student,
            'array' => $array,
            'max_time' => $max_time,
        ]);
    }
}
