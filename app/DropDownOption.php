<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DropDownOption extends Model
{
    protected $table = 'drop_down_options';
    protected $fillable = [
        'drop_down_id','sec_dropdown_id', 'option_name'
    ];

    public function dropdown(){
        return $this->belongsTo(DropDown::class);
    }
}
