<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diff extends Model
{
    protected $fillable = [
        'log_id',
        'field',
        'old_value',
        'new_value',
        'notes',
    ];

    public function log()
    {
        return $this->belongsTo('Log');
    }
}
