<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class pathway_model extends Model
{
   public $pathway_id;
   public $pathway_name;
   static function get_all(){
      $sql = "SELECT * FROM pathway";
      $arr_pathway = DB::select($sql);
      return $arr_pathway;
   }

   public function pathway_insert_process(){
      $sql = "INSERT INTO pathway (pathway_name) values ('$this->pathway_name')";
      DB::insert($sql);
   }

   static function get_one($pathway_id){
    $arr_pathway = DB::select("select * from pathway where pathway_id = ?",[
       $pathway_id
    ]);
    return $arr_pathway;
  }

  public function pathway_update_process(){
    DB::update("update pathway set pathway_name=? where pathway_id=?",[
       $this->pathway_name,
       $this->pathway_id
    ]);
  }
}
