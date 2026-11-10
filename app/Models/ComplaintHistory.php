<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintHistory extends Model
{
    protected $fillable = [
        'complaint_id',
        'status',
        'changed_by',
        'note',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
