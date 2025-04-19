<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'plan_id',
        'plan_started_at',
        'plan_ends_at', 
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'plan_started_at' => 'datetime',
        'plan_ends_at' => 'datetime',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function getSimulatedTokenBalance()
    {
        if (!$this->plan || !$this->plan_started_at) {
            return 0;
        }
    
        // Convert to Carbon if needed
        $startDate = $this->plan_started_at instanceof Carbon 
            ? $this->plan_started_at 
            : Carbon::parse($this->plan_started_at);
        $now = now();
        
        // If the plan hasn't started yet (future date), return 0
        if ($startDate->isAfter($now)) {
            return 0;
        }
        
        // Calculate correct positive time difference
        $seconds = $startDate->diffInSeconds($now);
        
        // Calculate tokens earned
        $tokensPerSecond = $this->plan->tokens_per_day / 86400; // 86400 seconds/day
        return round($seconds * $tokensPerSecond, 6);
    }
    public function isPlanExpired()
{
    return $this->plan_ends_at && now()->greaterThanOrEqualTo($this->plan_ends_at);
}
}
