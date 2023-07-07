<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueOptionNames implements Rule
{
    protected $dropDownId;

    public function __construct($dropDownId)
    {
        $this->dropDownId = $dropDownId;
    }

    public function passes($attribute, $value)
    {
        // Check if the option names are unique for the given drop_down_id
        $count = DB::table('drop_down_options')
        ->where('drop_down_id', $this->dropDownId)
        ->whereIn('option_name', $value)
        ->count(); 

        // Return true if the count is zero (unique), otherwise false
        return $count === 0;
    }

    public function message()
    {
        return 'The option names must be unique for the selected drop down.';
    }
}
