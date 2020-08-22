<?php

namespace App;
use App\student_view_model;
use Illuminate\Database\Eloquent\Model;
use DB;
class student_view_model extends Model
{
    public $student_id;
    public $class_id;
    public $student_name;
    public $address;
    public $student_phone_number;
    public $email ;
    public $password;
    static function get_one($student_id)
    {
        $sql ="select student.*,classes.class_name from student inner join classes on student.class_id = classes.class_id 
         where student.student_id=$student_id";
    	$result = DB::select($sql);
    	return $result;
    }

    public function change_information_process()
    {
        $result = DB::update("update student set address = ? , student_phone_number = ?, email = ? where student_id =?",
        [
            $this->address , $this->student_phone_number , $this->email , $this->student_id 
        ]);
    }

    static function get_password($student_id)
    {
        $password = DB::select("select * from  student where student.student_id=$student_id");
        return $password;
    }
    static function get_password_by_student_id($student_id)
    {
        $old_password = DB::select("select password from  student where student_id = $student_id");
        return $old_password;
    }
    public function change_password_process()
    {
        $result_password = DB::update("update student set  password = ? where student_id =?",
        [
          $this->password, $this->student_id 
        ]);
    }
}
