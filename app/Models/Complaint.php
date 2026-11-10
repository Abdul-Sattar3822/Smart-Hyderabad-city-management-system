<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        'city',
        'priority',
        'location',
        'status',
        'category',
        'latitude',
        'longitude',
        'rating',
        'feedback',
        'department_id',
        'assigned_at',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class);
    }

    public function histories()
    {
        return $this->hasMany(ComplaintHistory::class)->orderBy('created_at', 'asc');
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'asc');
    }
}
