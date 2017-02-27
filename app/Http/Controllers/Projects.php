<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class Projects extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'projects' => Project::all(),
        ];
        return view('projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Project::create([
                                       'name' => $request->get('name'),
                                       'description' => $request->get('description')
                                   ]);
        if ($project) {
            return redirect('projects');
        }
        return redirect('projects/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::where('id', $id)->first();

        if (!$project) {
            return redirect('projects');
        }

        $data = [
            'project' => $project,
        ];

        return view('projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::where('id', $id)->first();

        if (!$project) {
            return redirect('projects');
        }

        $data = [
            'project' => $project,
        ];

        return view('projects.edit', $data);
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
    }

    /**
     * Process datatables ajax request.
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax_list(Request $request)
    {
        $projects = Project::select(['id', 'name', 'description', 'created_at', 'updated_at']);

        return Datatables::of($projects)
            ->addColumn('action', function ($project) {
                return view('partials.datatables.basic_actions',
                            [
                                'controller'    => 'projects',
                                'id'            => $project->id,
                                'edit'          => true,
                                'delete'        => Auth::user()->level_id == 7 ? true : false,
                            ]
                )->render();
            })
            ->editColumn('name', function($stream) {
                return sprintf("<a href='%s'> %s</a>", action('Projects@show', $stream->id), $stream->name);
            })
            ->make(true);
    }
}
