<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Stream;
use App\Models\Log as LogModel;
use App\Http\Requests;
use Yajra\Datatables\Datatables;

class Logs extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //levels
        $levels = new Level();
        $levels = ['' => "All"] + $levels->levels();
        $data = [
            'logs' => [],
            'levels' => $levels,
            'streams' => Stream::lists('name', 'id')->prepend('All', 0),
        ];
        return view('logs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        dd("show?");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $log = LogModel::where('id', $id)->first();

        if (!$log) {
            return redirect('logs');
        }

        $data = [
            'log' => $log,
        ];

        return view('logs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        dd("wot?");
    }

    /**
     * Process datatables ajax request.
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax_list(Request $request)
    {
        $date_from  = $request->get('date_from');
        $time_from  = $request->get('time_from');
        $date_to    = $request->get('date_to');
        $time_to    = $request->get('time_to');
        $level      = $request->get('level');
        $stream     = $request->get('stream');

        $logs = Log::select(['id', 'date', 'message', 'have_diff' ,'level', 'stream_id']);

        if (!is_null($date_from) && !empty($date_from)) {
            if (!empty($time_from)) {
                $date_from = sprintf("%s %s", $date_from, $time_from);
            }
            $logs->where('date', '>=', $date_from);
        }

        if (!is_null($date_to) && !empty($date_to)) {
            if (!empty($time_to)) {
                $date_to = sprintf("%s %s", $date_to, $time_to);
            }
            $logs->where('date', '<=', $date_to);
        }

        if (!is_null($level) && !empty($level)) {
            $logs->where('level', $level);
        }

        if (!is_null($stream) && !empty($stream)) {
            $logs->where('stream_id', $stream);
        }

        return Datatables::of($logs)
            ->addColumn('action', function ($log) {
                return view('partials.datatables.basic_actions',
                            [
                                'controller'    => 'logs',
                                'id'            => $log->id,
                                'edit'          => true,
                                'delete'        => false
                            ]
                )->render();
            })
            ->editColumn('have_diff', function($log) {
                return view('logs.partials.diff', ['diff' => $log->have_diff])->render();
            })
            ->editColumn('level', function($log) {
                return view('logs.partials.level', ['level' => $log->level])->render();
            })
            ->editColumn('stream', function($log) {
                $stream_name = $log->stream->name;
                if ($log->stream->trashed()) {
                    $stream_name = sprintf("%s (Deleted)", $stream_name);
                }
                return $stream_name;
            })
            ->editColumn('date', function($log) {
                return sprintf("<a href='%s'> %s</a>", action('Logs@edit', $log->id), $log->date);
            })
            ->make(true);
    }
}
