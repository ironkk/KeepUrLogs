<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Log
 * @property integer $id
 * @property string $message
 * @property integer $level
 * @property integer $stream_id
 * @property integer $have_diff
 * @property string raw_input
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 */
class Log extends Model
{
    protected $fillable = [
        'date',
        'message',
        'level',
        'stream_id',
        'raw_input',
        'have_diff',
    ];

    public function stream()
    {
        return $this->belongsTo('Stream')->withTrashed();
    }

    public function diffs()
    {
        return $this->hasMany('Diff');
    }

    public function levelName()
    {
        if ($this->level == 1) {
            return trans('log.level_info');
        } elseif ($this->level == 2) {
            return trans('log.level_warning');
        }

        return trans('log.level_error');
    }

    public static function messagesInDays($level , $date = null)
    {
        $count  = Log::where('level', $level);

        if (is_null($date)) {
            $date = new \DateTime('today - 30 days');
        }

        $count->where('date', '>=', $date);

        return $count->count();
    }

    public static function recentsLogs($num = null, $date = null)
    {
        $logs = new Log;

        if (is_null($num)) {
            $num = 50;
        }

        if (!is_null($date)) {
            $logs->where('date', '>=', $date);
        }

        return $logs->orderBy('date', 'desc')->take($num)->get();
    }
}
