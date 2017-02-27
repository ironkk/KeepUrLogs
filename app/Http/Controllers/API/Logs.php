<?php

namespace App\Http\Controllers\API;

use App\Models\Diff;
use Illuminate\Http\Request;
use App\Models\Log as LogModel;
use App\Models\Stream;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use App\Dustycode\libraries\Apihelper;
use App\Jobs\ProcessLogs;

class Logs extends Controller
{
    /**
     * This function returns a PONG :)
     * @return Response $response
     */
    public function ping()
    {
        return Apihelper::response(true, 'pong');
    }

    /**
     * This store a log that can have diff in it
     * @param Request $request
     * @return Response $response
     */
    public function store(Request $request)
    {
        $message = null;
        $success = false;
        $log = new LogModel();
        $log->message = $request->get('action');
        $log->date = $request->get('date');
        $log->level = $request->get('level');
        $log->have_diff = $request->get('have_diff');
        $stream = Stream::where('api_key', $request->get('api_token'))->first();
        $log->stream_id = $stream->id;
        if ($log->save()) {
            $success = true;
            $message = "Log successfully saved";
            if ($log->have_diff == 1) {
                Log::info('Log have diffs, saving them');
                foreach ($request->get('diffs') as $diff) {
                    $diff_model = new Diff();
                    $diff_model-> log_id = $log->id;
                    $diff_model->field = $diff['field'];
                    $diff_model->old_value = $diff['old_value'];
                    $diff_model->new_value = $diff['new_value'];
                    if ($diff_model->save()) {
                        $success = true;
                        $message = 'Log successfully saved with diffs';
                    } else {
                        $success = false;
                    }
                }
            }
        } else {
            $message = 'Log can not be saved';
        }

        return Apihelper::response($success, $message);
    }

    /**
     * This function returns the 100 recents logs
     * @param Request $request
     * @return Response $response
     */
    public function recents(Request $request)
    {
        $logs = LogModel::select('id', 'message', 'date', 'level', 'stream_id', 'raw_input', 'have_diff')
                ->orderBy('date')
                ->take(100)
                ->get();

        return Apihelper::response(true, null, $logs);
    }

    /**
     * This function returns a collection of diffs for a current log
     * @param Request $request
     * @return Response $response
     */
    public function diffs(Request $request)
    {
        $success = false;
        $log = LogModel::where('id', $request->get('log_id'))->first();

        if (!$log) {
            $message = "Invalid log id";
            Apihelper::response($success, $message);
        } else {
            $success = true;
        }

        $diffs = $log->diffs()->select('field','old_value', 'new_value', 'created_at')->get();
        
        return Apihelper::response($success, null, null, $diffs);
    }
}
