<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Department extends Authenticatable
{
    protected $guard = 'department';

    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
        'icon',
        'is_active'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Relationship: Department has many complaints
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
