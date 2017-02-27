<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Models\Log;

class Dashboard extends Controller
{
    public function index()
    {
        $data = [
            'info_msg_count' => Log::messagesInDays(1),
            'warning_msg_count' => Log::messagesInDays(2),
            'error_msg_count' => Log::messagesInDays(3),
            'recent_logs' => Log::recentsLogs(),
        ];

        return view('dashboard.index', $data);
    }



}
