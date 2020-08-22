<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class mark_view_model extends Model
{
    public $class_name;
    static function get_student_by_classes($class_id){
        $arr_student = DB::select('select student_id, student_name from student
                            where class_id = ?', [
            $class_id
        ]);
        return $arr_student;
    }
    // static function get_mark($student_id,$subject_id){
    //     $array = DB::select("select * from mark where student_id =? and subject_id = ?",[
    //         $student_id,
    //         $subject_id
    //     ]);
    //     // dd($array);
    //     return $array;
    // }

    static function get_mark($class_id,$subject_id){
        $array = DB::select("SELECT 
                student.student_name,
                (select mark from mark where mark.student_id = student.student_id and mark.exam_times = 1 and subject_id = $subject_id) as first_mark,
                (select max(mark) from mark where mark.student_id = student.student_id and mark.exam_times > 1 and subject_id = $subject_id) as diem_thi_lai
                FROM student
                where class_id = '$class_id'");
        return $array;
    }

    static function get_mark_by_class_and_subject($class_id,$subject_id){
        $select = "select mark.* from mark
        join student on student.student_id = mark.student_id
        where student.class_id = '$class_id' and mark.subject_id = '$subject_id'";
        $array = DB::select( $select);
       // dd ($select);
        return $array;
    }
    static function get_max_exam_times_by_class_and_subject($class_id,$subject_id){
        $select = "select max(exam_times) as max_time from mark
        join student on student.student_id = mark.student_id
        where student.class_id = '$class_id' and mark.subject_id = '$subject_id'";
        $array = DB::select( $select);
        
        return $array[0]->max_time;
    }
}
