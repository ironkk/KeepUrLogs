<?php
namespace App\Dustycode\libraries;

use Illuminate\Support\Facades\Response;

class Apihelper {
    
    /**
     * Return a valid JSON response with HTTP 200 code
     * and a content-type JSON
     * @param $success
     * @param $msg
     * @param $logs
     * @param diffs
     * @return mixed
     */
    public static function response($success, $msg = null, $logs = null, $diffs = null)
    {
        $data = [];
        $data['success'] = $success;
        if (!is_null($msg)) {
            $data['message'] = $msg;
        }
        if (!is_null($logs)) {
            $data['logs'] = $logs;
        }
        if (!is_null($diffs)) {
            $data['diffs'] = $diffs;
        }
        return response()->json($data);
    }
}