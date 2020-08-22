<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\subject_model;
use\App\classes_model;
use\App\student_model;
use\App\mark_model;
class mark_controller extends Controller
{
    public function choose_class_subject(){
        $arr_class = classes_model::get_all();
        return view('mark/choose_class_subject',compact('arr_class'));
    }

    public function get_subject(Request $rq){
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
        $arr_mark = mark_model::get_mark_by_class_and_subject($class_id,$subject_id);

        $array = [];
        foreach ($arr_mark as $each){
            $student_id = $each->student_id;
            $exam_times = $each->exam_times;
            $array[$student_id][$exam_times] = $each->mark;
        }
        $max_time =  mark_model::get_max_exam_times_by_class_and_subject($class_id,$subject_id) + 1;

        return view('mark/list_mark',[
            'arr_class' => $arr_class,
            'arr_subject' => $arr_subject,
            'class_id' => $class_id,
            'subject_id' => $subject_id,
            'arr_student' => $arr_student,
            'array' => $array,
            'max_time' => $max_time,
        ]);
    }

    public function process_mark(Request $rq){
        $arr_mark = $rq->get('array_mark');
        $subject_id = $rq->get('subject_id');
        // $exam_times = $rq->get('exam_times');
        dd($subject_id);
        foreach($arr_mark as $student_id => $mark_exam_times){
            $object = new mark_model();
            $object->subject_id = $subject_id;
            $object->student_id = $student_id;
            foreach ($mark_exam_times as $exam_times => $mark){
                if($mark){
                    $object->exam_times = $exam_times;
                    $check = $object->check_previous_mark();
                    if(empty($check)){
                        $object->mark = $mark;
                        $object->insert();
                    }
                }
            }
        }
        return redirect()->back();
    }

    public function submit_mark(Request $rq){
        $object = new mark_model();
        $object->subject_id = $rq->subject_id;
        $object->student_id = $rq->student_id;
        $object->exam_times = $rq->exam_times;
        if($rq->mark==''){
            $object->delete();
            return 1;
        }

        $check = $object->check_previous_mark();
        if(empty($check)){
            $object->mark = $rq->mark;
            $object->insert();
            return 1;
        }
        else{
            throw new \Exception("1");
        }
    }
    
}