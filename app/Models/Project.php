<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id'
    ];

    // Owner
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Team members
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }
}