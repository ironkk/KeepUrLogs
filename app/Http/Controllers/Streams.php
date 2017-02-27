<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stream;
use App\Models\Project;
use Yajra\Datatables\Datatables;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Streams extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'streams' => Stream::all(),
        ];
        return view('streams.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'projects' => Project::select('id', 'name')->orderBy('id')->get(),
        ];
        return view('streams.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'    => 'required',
            'project' => 'required',
        ];

        /** @var Validator $validator */
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        $stream = Stream::create(
            [
                'name'       => $request->get('name'),
                'project_id' => $request->get('project'),
                'active'     => $request->get('active') == "on" ? 1 : 0
            ]
        );

        if ($stream) {
            return redirect('streams');
        }
        return redirect('streams/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stream = Stream::where('id', $id)->first();

        if (!$stream) {
            return redirect('streams');
        }

        $data = [
            'stream'   => $stream,
            'projects' => Project::select('id', 'name')->orderBy('id')->get(),
        ];

        return view('streams.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stream = Stream::where('id', $id)->first();

        if (!$stream) {
            return redirect('streams');
        }

        $data = [
            'stream'   => $stream,
            'projects' => Project::select('id', 'name')->orderBy('id')->get(),
        ];

        return view('streams.edit', $data);
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
        /** @var Stream $stream */
        $stream = Stream::where('id', $id)->first();
        if ($stream) {

            try {
                $this->authorize('update', $stream);
                $stream->name = $request->get('name');
                $stream->project_id = $request->get('project_id');
                if ($request->get('new_api_key') == "true") {
                    $stream->api_key = $request->get('api_key');
                }
                $stream->active = $request->get('active') == "on" ? 1 : 0;
                $stream->save();

                $message = sprintf("Stream %s of Project %s have been updated successfully", $stream->name, $stream->project->name);
                $status = "success";
            } catch (\Exception $e) {
                $message = trans('site.not_authorized');
                $status = "danger";
            }

            return redirect()->back()
                ->with('message', $message)
                ->with('m-status', $status);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stream = Stream::find($id);
        $message = null;
        $status = null;

        if ($stream) {
            try {
                $this->authorize('destroy', $stream);
                $message = sprintf("Stream %s of project %s have been deleted successfully", $stream->name, $stream->project->name);
                $status = "success";
                $stream->delete();
            } catch (\Exception $e) {
                $message = trans('site.not_authorized');
                $status = "danger";
            }
            return redirect('streams')
                ->with('message', $message)
                ->with('m-status', $status);
        }
        return redirect('streams')
            ->with('message', sprintf("Can not delete Stream %s", $stream->name))
            ->with('m-status', 'danger');
    }

    /**
     * Process datatables ajax request.
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax_list(Request $request)
    {
        $streams = Stream::select(['id', 'name', 'project_id', 'active', 'created_at', 'updated_at']);

        return Datatables::of($streams)
            ->addColumn('action', function ($stream) {
                return view('partials.datatables.basic_actions',
                            [
                                'controller'    => 'streams',
                                'id'            => $stream->id,
                                'edit'          => true,
                                'delete'        => Auth::user()->level_id == 7 ? true : false,
                            ]
                )->render();
            })
            ->editColumn('project_id', function($stream) {
                return $stream->project->name;
            })
            ->editColumn('active', function($stream) {
                return view('streams.partials.active', ['active' => $stream->active])->render();
            })
            ->editColumn('name', function($stream) {
                return sprintf("<a href='%s'> %s</a>", action('Streams@show', $stream->id), $stream->name);
            })
            ->make(true);
    }

    public function ajax_regenerate_Api_key()
    {
        return Stream::generateApiKey();
    }
}

