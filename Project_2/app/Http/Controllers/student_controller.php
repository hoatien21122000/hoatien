<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pathway_model;
use App\academic_year_model;
use App\classes_model;
use App\student_model;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
class student_controller extends Controller
{
    public function list_student(){
        $arr_class = classes_model::get_all1();
        $arr_student = student_model::get_all();

        return view('student/list_student',compact('arr_class','arr_student'));
    }

    public function get_student_by_class(Request $rq){
        $id_class = $rq->get('id_class');
        // $class = student_model::get_student_by_class($id_class);

        $student = '';
        if($id_class != 0 ){
            $student = student_model::get_student_by_class($id_class);
        }
        else if($id_class == 0 ){
            $student = student_model::get_all();
        }

        $string_option = "";
        foreach ($student as $each){
            $link_update = route("student_management.student_update",['student_id' => $each->student_id]);
            $string_option .= "
                <tr>
                    <td>$each->student_id</td>
                    <td>$each->class_name</td>
                    <td>$each->student_name</td>
                    <td>$each->address</td>
                    <td>$each->student_phone_number</td>
                    <td>$each->email</td>
                    <td>$each->password</td>     
                    <td><a href='".$link_update."'>Sua</a></td>
                </tr>
            ";
        }
        echo ($string_option);
    }

    public function student_insert(){
        $arr_pathway = pathway_model::get_all();
        $arr_academic_year = academic_year_model::get_all();
        return view('student/insert_student',compact('arr_pathway','arr_academic_year'));
    }

    public function student_insert_excel(){
        $arr_class = classes_model::get_all();
        // $arr_academic_year = academic_year_model::get_all();
        return view('student/insert_student_excel',compact('arr_class'));
    }

    public function student_process_insert_excel(Request $rq){
        $file = $rq->file_excel;
        Excel::load($file, function($reader) use ($rq) {
            $results = $reader->get();
            foreach ($results as $each) {
                $student = new student_model();
                // dd($student);
                $student->class_id = $rq->class_id;
                $student->student_name = $each['student_name'];
                $student->address = $each['address'];
                $student->student_phone_number = $each['student_phone_number'];
                $student->email = $each['email'];
                $student->password = $each['password'];
                $rq->session()->flash('status', 'Task was successful!');
                $student->student_insert_process();
                
                }
            });
        return redirect()->route('student_management.list_student');
        
    }

    public function get_class_by_pathway_academic_year_insert(Request $rq){
        $id_pathway = $rq->get('id_pathway');
        $id_academic_year = $rq->get('id_academic_year');
        $pathway = '';
        if($id_pathway != 0 && $id_academic_year == 0){
            $pathway = classes_model::get_class_by_pathway($id_pathway);
        }
        else if($id_academic_year != 0 && $id_pathway == 0){
            $pathway = classes_model::get_class_by_year($id_academic_year);
        }
        else if($id_academic_year != 0 && $id_pathway != 0){
            $pathway = classes_model::get_class_by_pathway_academic_year($id_pathway,$id_academic_year);
        }
        // dd($pathway);
        $string_option = "<option value='0'>----- Choose Class -----</option>";
        
        // dd($pathway);
        if($pathway != ''){
            foreach ($pathway as $each){
                $string_option .= "
                    <option value='$each->class_id'>$each->class_name</option>
                ";
            }
        }
        echo ($string_option);
    }

    public function student_insert_process(Request $rq){
        $this->validate($rq,[
            'class_id' => 'required:student,class_id',
            'student_name' => 'required|min:5|max:100:student,student_name',
            'address' => 'required|min:5:student,address',
            'student_phone_number' => 'required|regex:/(0)[0-9]{9}/',
            'email' => 'required|unique:student,email',
            'password' => 'required|min:6:student,password'
        ],
        [
            'class_id.required'=>'Please choose Class',
            'student_name.required'=>'Please enter Student Name',
            'student_name.min'=>'Student Name absurd, Please enter again',
            'student_name.max'=>'Student Name absurd, Please enter again',
            'student_name.alpha'=>'Please enter Student Name again',
            'address.required'=>'Please enter Address',
            'address.min'=>'Please enter Address again',
            'student_phone_number.required'=> 'Please enter Telephone Number',
            'student_phone_number.regex' =>'Phone Number absurd, Please enter again',
            'email.required'=> 'Please enter Email',
            'email.unique' => 'Email absurd, Please enter again',
            'password.required'=> 'Please enter password',
            'password.min' => 'password absurd (>6), Please enter again'
        ]);
        $student = new student_model();
        $student->class_id = $rq->class_id;
        $student->student_name = $rq->student_name;
        $student->address = $rq->address;
        $student->student_phone_number = $rq->student_phone_number;
        $student->email = $rq->email;
        $student->password = $rq->password;
        $rq->session()->flash('status', 'Task was successful!');
        $student->student_insert_process();
        return redirect()->route('student_management.list_student');
    }

    public function student_update($student_id){
        $arr_class = classes_model::get_all();
        $arr_student = student_model::get_one($student_id);
        //dd($arr_class);
        return view('student/update_student',compact('arr_student','arr_class'));
    }
    public function student_update_process($student_id, Request $rq){
        $this->validate($rq,[
            'class_id' => 'required:student,class_id',
            'student_name' => 'required|min:5|max:100:student,student_name',
            'address' => 'required|min:5:student,address',
            'student_phone_number' => 'required|regex:/(0)[0-9]{9}/',
            'email' => 'required:student,email',
            'password' => 'required|min:6:student,password'
        ],
        [
            'class_id.required'=>'Please choose Class',
            'student_name.required'=>'Please enter Student Name',
            'student_name.min'=>'Student Name absurd, Please enter again',
            'student_name.max'=>'Student Name absurd, Please enter again',
            'student_name.alpha'=>'Please enter Student Name again',
            'address.required'=>'Please enter Address',
            'address.min'=>'Student Name absurd, Please enter again',
            'student_phone_number.required'=> 'Please enter Telephone Number',
            'student_phone_number.regex' =>'Phone Number absurd, Please enter again',
            'email.required'=> 'Please enter Email',
            'password.required'=> 'Please enter password',
            'password.min' => 'password absurd (>6), Please enter again'
        ]);
        $student = new student_model();
        $student->class_id = $rq->class_id;
        $student->student_name = $rq->student_name;
        $student->address = $rq->address;
        $student->student_phone_number = $rq->student_phone_number;
        $student->email = $rq->email;
        $student->password = $rq->password;
        $rq->session()->flash('status', 'Task was successful!');
        $student->student_update_process();
        return redirect()->back();
    }
}
