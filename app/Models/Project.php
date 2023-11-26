<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'goal',
        'current_amount',
        'deadline',
        'photo',
        'video',
        'user_id',
        'type_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    public function getTotalContributions()
    {
        return $this->contributions()->sum('amount');
    }
    public function updates()
    {
        return $this->hasMany(Update::class);
    }
    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }

    public function getPercentageCompleted()
    {
        return round(($this->current_amount / $this->goal) * 100);
    }
}
