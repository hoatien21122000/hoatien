<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class pathway_subject_model extends Model
{
    public $subject_id;
    public $pathway_id;
    static function get_subject_by_pathway($pathway_id){
        $arr_ps = DB::select("SELECT pathway.*, subject.subject_id, subject.subject_name from pathway
                                INNER JOIN pathway_subject on pathway.pathway_id=pathway_subject.pathway_id
                                INNER JOIN subject on pathway_subject.subject_id = subject.subject_id where pathway.pathway_id=?",[
                                    $pathway_id
                                ]);
        return $arr_ps;
    }

    // static function get_one($subject_id){
    //     $arr_subject = DB::select("select subject.*,pathway.pathway_name,pathway.pathway_id from subject 
    //     inner join pathway_subject on subject.subject_id = pathway_subject.subject_id
    //    inner join pathway on pathway_subject.pathway_id = pathway.pathway_id where subject.subject_id=?",[
    //    $subject_id
    //    ]);
    //     //dd($arr_subject);
    //     return $arr_subject;
    //   }

    static function check_ps($pathway, $subject)
    {
        $result = DB::select("select * from pathway_subject where pathway_id like ? and subject_id = ?",[
            $pathway,
            $subject
        ]);
        return $result;
    }

    public function insert_process(){
        $sql = "INSERT INTO pathway_subject (pathway_id, subject_id) 
        values ('$this->pathway_id', '$this->subject_id')";
        DB::insert($sql);
    }
}
