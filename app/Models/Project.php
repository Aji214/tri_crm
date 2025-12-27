<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['user_id', 'lead_id', 'name', 'total_amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function items()
    {
        return $this->hasMany(ProjectItem::class);
    }

    /**
     * Scope to filter projects based on user role
     */
    public function scopeForUser($query, $user)
    {
        if ($user->isManager()) {
            return $query; // Manager sees all
        }
        return $query->where('user_id', $user->id); // Sales sees only their own
    }
}
