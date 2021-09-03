<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DropDown extends Model
{
    public function options(){
        return $this->hasMany(DropDownOption::class);
    }
}
