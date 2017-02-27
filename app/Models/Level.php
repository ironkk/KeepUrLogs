<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    //
    protected $levels = [
        1 => "Info",
        2 => "Warning",
        3 => "Error"
    ];

    public function levels()
    {
        return $this->levels;
    }
}
