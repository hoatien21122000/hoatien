<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class login_student_model extends Model
{
    public $student_id;
    public $class_id;
    public $student_name;
    public $address;
    public $student_phone_number;
    public $email;
    public $password;
    static function login_student_process($email,$password)
    {
        $student = DB::select("select * from student where email = ? and password = ?",
                [	$email,
                    $password	]);
        return $student;
    }
}
