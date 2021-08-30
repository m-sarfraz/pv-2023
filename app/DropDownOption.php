<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DropDownOption extends Model
{
    protected $fillable = [
        'dropdown_id','sec_dropdown_id', 'option_name'
    ];
}
