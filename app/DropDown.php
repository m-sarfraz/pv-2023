<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DropDown extends Model
{
    protected $fillable = [
        'name','type'
    ];
    public function options(){
        return $this->hasMany(DropDownOption::class);
    }
}
