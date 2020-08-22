<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subject_model;
use App\student_mark_model;
class student_mark_controller extends Controller
{
    public function choose_subject()
	{
		$arr_subject = subject_model::get_all();
		return view('student_view/choose_subject',compact('arr_subject'));
	}
	public function search_subject(Request $rq)
	{
		$student_id = $rq->session()->get('student_id');
		$search = $rq->get('search_subject');
		$subject = student_mark_model::get_subject($search,$student_id);
        return view('student_view.search_subject',compact('subject'));
	}
	public function view_mark(Request $rq)
	{
		$student_id = $rq->session()->get('student_id');
		$arr_mark = student_mark_model::get_mark($student_id);
		$array = [];
        foreach ($arr_mark as $each){
            $student_id = $each->student_id;
            $exam_times = $each->exam_times;
            $subject_id = $each->subject_id;
            $array[$student_id][$subject_id][$exam_times] = $each->mark;
        }
        $max_time =  student_mark_model::get_max_exam_times_by_student_id($student_id) + 1;
        return view('student_view/view_mark',[
        	'student_id' => $student_id,
            'array' => $array,
            'arr_mark'=>$arr_mark,
            'max_time' => $max_time,
        ]);
	}

}
