<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CandidateInformation extends Model
{
    protected $table = 'candidate_informations';
    public function user()
    {
        return $this->belongsTo(User::class, 'saved_by', 'id');
    }
}
