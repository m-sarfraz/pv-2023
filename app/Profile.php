<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'candidate_profile';
    public function subSegment()
    {
        return $this->belongsTo(SubSegment::class);
    }

}
