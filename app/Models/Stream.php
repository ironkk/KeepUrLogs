<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stream extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'project_id', 'active'];

    public function project()
    {
        return $this->belongsTo('Project');
    }

    public function save(array $options = []) {
        if (!$this->exists) {
            $this->api_key = $this->generateApiKey();
        }
        parent::save();
    }

    public static function generateApiKey() {

        do {
            $api_key = str_random('17');

        } while(Stream::where('api_key', $api_key)->first() != null);

        return $api_key;
    }
}
