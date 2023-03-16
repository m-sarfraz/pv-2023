<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'domain_name',
    ];
    public function segments()
    {
        return $this->hasMany(Segment::class, 'domain_id', 'id');
    }

    public static function booted()
    {
        static::deleting(function ($domain) {
            $domain->segments()->each(function ($segment) {
                $segment->sub_segments()->each(function ($subSegment) {
                    $subSegment->profile()->delete(); // delete profile
                    $subSegment->delete(); // delete the sub segment
                });
                $segment->delete(); // delete the segment
            });
        });
    }

}
