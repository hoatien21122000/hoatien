<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class login_teacher_model extends Model
{
    public $teacher_name;
    public $teacher_phone_number;
    public $email;
    public $password;
    public $sex;
    public $address;
    public $date_of_birth;
    public function get_one(){
        $array = DB::select('select * from teacher where email = ? and password = ?',[
            $this->email,
            $this->password
        ]);
        return $array;
    }
}
