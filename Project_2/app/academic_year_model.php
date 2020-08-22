<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class academic_year_model extends Model
{
   public $academic_year_id;
   public $academic_year_name;
   static function get_all(){
      $sql = "SELECT * FROM academic_year";
      $arr_academic_year = DB::select($sql);
      return $arr_academic_year;
   }
   public function academic_year_insert_process(){
    $sql = "INSERT INTO academic_year (academic_year_name) values ('$this->academic_year_name')";
    DB::insert($sql);
   }

   static function get_one($academic_year_id){
    $arr_academic_year = DB::select("select * from academic_year where academic_year_id = ?",[
       $academic_year_id
    ]);
    return $arr_academic_year;
   }

  public function academic_year_update_process(){
    DB::update("update academic_year set academic_year_name=? where academic_year_id=?",[
       $this->academic_year_name,
       $this->academic_year_id
    ]);
  }
}
