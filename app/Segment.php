<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $fillable = [
        'segment_name',
    ];
    public function sub_segments()
    {
        return $this->hasMany(SubSegment::class, 'segment_id', 'id');
    }
    public static function booted()
    {
        static::deleting(function ($segment) {
            $segment->sub_segments->each(function ($subSegment) {
                $subSegment->profile()->delete(); // delete profiles related to the sub segment
                $subSegment->delete(); // delete the sub segment itself
            });
        });
    }
}
