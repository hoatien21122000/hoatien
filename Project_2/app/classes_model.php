<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class classes_model extends Model
{
    public $academic_year_id;
    public $pathway_id;
    public $class_name;
    static function get_class_by_pathway_academic_year($id_pathway,$id_academic_year){
        $pathway = DB::select('select classes.*,pathway.pathway_name,academic_year.academic_year_name from classes inner join pathway on classes.pathway_id = pathway.pathway_id 
        inner join academic_year on classes.academic_year_id = academic_year.academic_year_id
        where classes.pathway_id = ? and classes.academic_year_id = ?', [
            $id_pathway,
            $id_academic_year
        ]);
        return $pathway;
    }
    static function get_class_by_pathway($id_pathway){
        $pathway = DB::select('select classes.*,pathway.pathway_name,academic_year.academic_year_name from classes inner join pathway on classes.pathway_id = pathway.pathway_id 
        inner join academic_year on classes.academic_year_id = academic_year.academic_year_id
        where classes.pathway_id = ?', [
            $id_pathway
        ]);
        return $pathway;
    }
     static function get_class_by_year($id_academic_year){
        $pathway = DB::select('select classes.*,pathway.pathway_name,academic_year.academic_year_name from classes inner join pathway on classes.pathway_id = pathway.pathway_id 
        inner join academic_year on classes.academic_year_id = academic_year.academic_year_id
        where classes.academic_year_id = ?', [
            $id_academic_year
         ]);
        return $pathway;
    }

    static function check($pathway, $academic_year, $class)
    {
        $result = DB::select("select * from classes where pathway_id like ? and academic_year_id = ? and class_name = ?",[
            $pathway,
            $academic_year,
            $class
        ]);
        return $result;
    }

    public function class_insert_process(){
        $sql = "INSERT INTO classes (academic_year_id, pathway_id, class_name) 
                                        values ('$this->academic_year_id', '$this->pathway_id', '$this->class_name')";
        DB::insert($sql);
    }
    
    static function get_one($class_id){
         $arr_class = DB::select("select classes.*,pathway.pathway_name,academic_year.academic_year_name from classes inner join pathway on classes.pathway_id = pathway.pathway_id 
         inner join academic_year on classes.academic_year_id = academic_year.academic_year_id
         where classes.class_id = ?",[
            $class_id
         ]);
        return $arr_class;
    }

    public function class_update_process(){
        DB::update("update classes set academic_year_id=?, pathway_id=?, class_name=? where class_id=?",[
           $this->academic_year_id,
           $this->pathway_id,
           $this->class_name,
           $this->class_id
        ]);
    }
    static function get_all(){
        $sql = "SELECT * FROM classes";
        $arr_class = DB::select($sql);
        return $arr_class;
    }

    static function get_all1(){
        $sql = "select classes.*,pathway.pathway_name,academic_year.academic_year_name from classes inner join pathway on classes.pathway_id = pathway.pathway_id 
        inner join academic_year on classes.academic_year_id = academic_year.academic_year_id";
        $arr_class = DB::select($sql);
        return $arr_class;
    }
}