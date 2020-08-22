<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class statistical_demol extends Model
{
    public $subject;
    static function count_subject(){
        $subject=DB::select("select count(subject_id) as tong_subject from subject");
        return $subject;
    }
    static function count_pathway(){
        $pathway=DB::select("select count(pathway_id) as tong_pathway from pathway");
        return $pathway;
    }
    static function count_academic_year(){
        $academic_year=DB::select("select count(*) as tong_academic_year from academic_year");
        return $academic_year;
    }

    static function count_teacher(){
        $teacher=DB::select("select count(*) as tong_teacher from teacher");
        return $teacher;
    }

    static function get_subject_by_pathway($pathway_id){
        $arr = DB::select("SELECT pathway.*, subject.subject_id, subject.subject_name from pathway
                                INNER JOIN pathway_subject on pathway.pathway_id=pathway_subject.pathway_id
                                INNER JOIN subject on pathway_subject.subject_id = subject.subject_id where pathway.pathway_id=?",[
                                    $pathway_id
                                ]);
        // dd($arr);
         return $arr;
    }

    static function get_number_student($pathway_id,$academic_year_id,$subject_id){
        // dd($subject_id);
        $array = DB::select('SELECT
                                classes.`class_id`,
                                classes.`class_name`,
                                (
                                SELECT 
                                COUNT(*)
                                FROM mark
                                LEFT JOIN student ON student.student_id = mark.`student_id`
                                WHERE 
                                mark.`mark` >= 5 
                                AND mark.`subject_id` = ?
                                AND student.`class_id` = classes.class_id
                                ) AS number_of_students_passing_subject,
                                (
                                    SELECT 
                                    COUNT(*)
                                    FROM student
                                    WHERE 
                                    student.`class_id` = classes.class_id
                                    and student.student_id not in(
                                        select student_id from mark where mark >= 5 AND mark.`subject_id` = ?
                                    )
                                )
                                AS number_of_students_dont_passing_subject
                            FROM
                                classes
                            WHERE (
                            classes.`academic_year_id` = ?
                                AND classes.`pathway_id` = ?
                            )
                            GROUP BY classes.`class_id`;',[
                                $subject_id,
                                $subject_id,
                                $academic_year_id,
                                $pathway_id
                            ]
        );
        return $array;
    }
}
