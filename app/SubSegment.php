<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSegment extends Model
{
    protected $fillable = [
        'segment_name',
    ];
    public static function booted()
    {
        static::deleting(function ($subSegment) {
            $subSegment->profile()->delete(); // delete all the profiles related to the sub segment
        });
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }

}
