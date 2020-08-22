<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class student_model extends Model
{
    static function get_all(){
        $sql = "select student.*,classes.class_name from student inner join classes on student.class_id = classes.class_id ";
        $arr_student = DB::select($sql);
        return $arr_student;
    }
    static function get_student_by_class($id_class){
        $sql = DB::select('select student.*,classes.class_name from student inner join classes on student.class_id = classes.class_id 
                            where student.class_id = ?', [
            $id_class
        ]);
        return $sql;
    }

    public function student_insert_process(){
        $sql = "INSERT INTO student (class_id, student_name, address, student_phone_number, email, password) 
        values ('$this->class_id', '$this->student_name', '$this->address', '$this->student_phone_number', '$this->email', '$this->password')";
        DB::insert($sql);
    }

    static function get_one($student_id){
        $arr_student = DB::select("select * from student
        where student_id = ?",[
           $student_id
        ]);
       return $arr_student;
   }

   public function student_update_process(){
    DB::update("update student set class_id=?, student_name=?, address=?, student_phone_number=?, email=?, password=? where student_id=?",[
        $this->class_id,
        $this->student_name,
        $this->address,
        $this->student_phone_number,
        $this->email,
        $this->password,
        $this->student_id
    ]);
  }

   static function get_student_by_classes($class_id){
    $arr_student = DB::select('select student_id, student_name from student
                        where class_id = ?', [
        $class_id
    ]);
    return $arr_student;
}
}
