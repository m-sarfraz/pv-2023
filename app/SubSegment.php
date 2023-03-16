<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSegment extends Model
{
    protected $fillable = [
        'segment_name',
    ];
    public function profile()
    {
        return $this->hasMany(Profile::class, 'sub_segment_id', 'id');
    }
    public static function booted()
    {
        static::deleting(function ($subSegment) {
            $subSegment->profile()->delete(); // delete all the profiles related to the sub segment
        });
    }
}
