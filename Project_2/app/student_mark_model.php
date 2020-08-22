<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class student_mark_model extends Model
{
    static function get_mark($student_id)
    {
        $select = "select mark.*,subject.* from mark join student on student.student_id = mark.student_id
                        join subject on subject.subject_id = mark.subject_id
                            where student.student_id = '$student_id' ";
        $array = DB::select( $select);
        return $array;
    }

    static function get_max_exam_times_by_student_id($student_id){
        $select = "select max(exam_times) as max_time from mark
                        join student on student.student_id = mark.student_id
                           where student.student_id = '$student_id' ";
        $array = DB::select( $select);
        return $array[0]->max_time;
    }

    static function get_subject($search,$student_id)
    {
    	/*$subject=DB::select('select subject.*, mark.subject_id, mark.exam_times, mark.mark from subject inner join mark on subject.subject_id = mark.subject_id where subject.subject_name LIKE "%?%"',
    		[$search]);*/
    	$subject = DB::table('subject')
                ->join('mark', 'subject.subject_id', '=', 'mark.subject_id')
                ->select('subject.*', 'mark.mark', 'mark.exam_times')
                ->where('subject.subject_name','like','%'.$search.'%')
                ->where('mark.student_id',$student_id)
                ->get();
        return $subject;
    }
}
