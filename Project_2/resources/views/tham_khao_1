<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class mark_model extends Model
{
    
    public function check_previous_mark(){
        $array = DB::select("select * from mark 
        where subject_id=? and student_id=? and exam_times=?-1 and mark >= 5",[
            $this->subject_id,
            $this->student_id,
            $this->exam_times
        ]);
        return $array;
    }
    public function delete(){
        $array = DB::select("delete from mark 
        where subject_id=? and student_id=? and exam_times=?",[
            $this->subject_id,
            $this->student_id,
            $this->exam_times
        ]);
        return $array;
    }
    public function insert(){
        // DB::connection()->enableQueryLog();
        DB::insert("replace into mark values (?,?,?,?)",[
            $this->subject_id,
            $this->student_id,
            $this->exam_times,
            $this->mark
        ]);
        // dd(DB::getQueryLog());
    }
    // public function update_mark(){
    //    // DB::connection()->enableQueryLog();
    //     DB::update("update mark set mark=? where subject_id=? and student_id=? and exam_times=?",[
    //         $this->mark,
    //         $this->subject_id,
    //         $this->student_id,
    //         $this->exam_times
    //     ]);
    //     //dd(DB::getQueryLog());
    // }
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