<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Earthquake extends Model
{
    protected $fillable = ['location', 'magnitude', 'time', 'depth'];

    protected $casts = [
        'time' => 'datetime',
    ];

    public $timestamps = true;

    public function scopeRecent($query, $limit = 50)
    {
        return $query->orderBy('time', 'desc')->limit($limit);
    }

    public function scopeByMagnitude($query, $minMagnitude = 0)
    {
        return $query->where('magnitude', '>=', $minMagnitude);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', 'like', '%' . $location . '%');
    }
    
    public function scopeByTimeRange($query, $startTime, $endTime)
    {
        return $query->whereBetween('time', [$startTime, $endTime]);
    }

    public function scopeWithMagnitudeRange($query, $minMagnitude, $maxMagnitude)
    {
        return $query->whereBetween('magnitude', [$minMagnitude, $maxMagnitude]);
    }

    public function scopeWithRecentData($query, $days = 7)
    {
        return $query->where('time', '>=', now()->subDays($days));
    }
}
