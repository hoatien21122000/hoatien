<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class subject_model extends Model
{
   public $subject_id;
   public $subject_name;
   public $pathway_id;
   static function get_all(){
      $sql = "SELECT * FROM subject";
      $arr_subject = DB::select($sql);
      return $arr_subject;
   }
   static function get_subject($class_id){
      $arr = DB::select("SELECT subject.subject_id, subject.subject_name from classes
      INNER JOIN `pathway`
        ON (
          classes.pathway_id = pathway.pathway_id
        )
      INNER JOIN pathway_subject
        ON (
          pathway_subject.pathway_id = pathway.pathway_id
        )
      INNER JOIN subject
        ON (
          pathway_subject.subject_id = subject.subject_id
        )
        where classes.class_id=?",[
              $class_id
      ]);
      //  dd($arr);
       return $arr;
  }

   public function subject_insert_process(){
      $sql = "INSERT INTO subject (subject_name) values ('$this->subject_name')";
      DB::insert($sql);
   }

   static function get_one($subject_id){
    $arr_subject = DB::select("select * from subject where subject.subject_id=?",[
   $subject_id
   ]);
    //dd($arr_subject);
    return $arr_subject;
  }
  
  public function subject_update_process(){
    DB::update("update subject set subject_name=? where subject_id=?",[
       $this->subject_name,
       $this->subject_id
    ]);
  }
  public function update_pathway_subject(){
     DB::update("update pathway_subject set pathway_id=? where subject_id=?",[
      $this->pathway_id,
      $this->subject_id
     ]);
  }
}
