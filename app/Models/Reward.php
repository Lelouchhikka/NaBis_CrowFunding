<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = ['project_id', 'title', 'description', 'min_contribution', 'max_backers'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

