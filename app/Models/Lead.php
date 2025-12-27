<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'contact',
        'address',
        'requirements',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Scope to filter leads based on user role
     */
    public function scopeForUser($query, $user)
    {
        if ($user->isManager()) {
            return $query; // Manager sees all
        }
        return $query->where('user_id', $user->id); // Sales sees only their own
    }
}
