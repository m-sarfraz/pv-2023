<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $fillable = [
        'segment_name',
    ];
    public static function booted()
    {
        static::deleting(function ($segment) {
            $segment->sub_segments->each(function ($subSegment) {
                $subSegment->profile()->delete(); // delete profiles related to the sub segment
                $subSegment->delete(); // delete the sub segment itself
            });
        });
    }
    public function subSegments()
    {
        return $this->hasMany(SubSegment::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
