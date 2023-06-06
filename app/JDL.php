<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JDL extends Model
{
    use HasFactory;
    protected $table = 'jdl';
    protected $fillable = [
        "budget" ,
        "c_level" ,
        "client" ,
        "closed_date" ,
        "domain" ,
        "edu_attainment" ,
        "id" ,
        "jd" ,
        "keyword" ,
        "location" ,
        "note" ,
        "os_date" ,
        "p_title" ,
        "poc" ,
        "priority" ,
        "recruiter" ,
        "ref_code" ,
        "req_date" ,
        "segment" ,
        "sll_no" ,
        "start_date" ,
        "status" ,
        "subsegment" ,
        "t_fte" ,
        "updated_date" ,
        "updated_fte" ,
        "w_schedule" ,
        "assignment" ,
        "classification" ,
        "req_classification" ,
        "client_classification" ,
        "req_id",
        "turn_around"
    ];
}
