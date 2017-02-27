<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userlevel extends Model
{
    public static function levels()
    {
        return [
            1 => 'user',
            7 => 'admin',
        ];
    }
}
