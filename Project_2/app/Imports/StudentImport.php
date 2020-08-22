<?php

namespace App\Imports;

use App\student_model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel,  WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new StudentImport([
            'student_name'=>$student_name,
            'address'=>$address,
            'student_phone_number'=>$student_phone_number,
            'email'=>$email,
            'password'=>$password,
            'class_id'=>$class_id,
        ]);
    }
}
