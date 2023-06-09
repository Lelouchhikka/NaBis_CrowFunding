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
    ];
    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    public function getTotalContributions()
    {
        return $this->contributions()->sum('amount');
    }

    public function getPercentageCompleted()
    {
        return round(($this->current_amount / $this->goal) * 100);
    }
}
