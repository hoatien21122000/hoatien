<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class teacher_model extends Model
{
    public $teacher_name;
    public $teacher_phone_number;
    public $sex;
    public $address;
    public $date_of_birth;
    public $email;
    public $password;
    static function get_all(){
        $arr_teacher = DB::select("SELECT * FROM teacher");
        return $arr_teacher;
    }

    public function teacher_insert_process(){
        $sql = "INSERT INTO teacher (teacher_name, teacher_phone_number, sex, address, date_of_birth, email, password) 
        values('$this->teacher_name', '$this->teacher_phone_number', '$this->sex', '$this->address', '$this->date_of_birth', '$this->email', '$this->password')";
        DB::insert($sql);
    }

    static function get_one($email){
        $arr_teacher = DB::select("select * from teacher where email = ?",[
           $email
        ]);
        return $arr_teacher;
    }

    public function teacher_update_process(){
        DB::update("update teacher set teacher_name=?, teacher_phone_number=?, sex=?, address=?, date_of_birth=?, password=? where email=?",[
           $this->teacher_name,
           $this->teacher_phone_number,
           $this->sex,
           $this->address,
           $this->date_of_birth,
           $this->password,
           $this->email
        ]);
      }
}
