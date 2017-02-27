<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Userlevel;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Users extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'levels' => Userlevel::levels(),
        ];
        return view('users.create', $data);
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
            'name'             => 'required',
            'email'            => 'required|unique:users,email',
            'password'         => 'required|min:3',
            'confirm_password' => 'required|min:3|same:password',
            'level'            => 'required',
        ];
        /** @var Validator $validator */
        $validator = Validator::make($request->all(), $rules);

        if ($request->get('level') == 0) {
            return back();
        }

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user               = new User();
        $user->name         = $request->get('name');
        $user->lastname     = $request->get('lastname');
        $user->email        = $request->get('email');
        $user->level_id     = $request->get('level');
        $user->password     = bcrypt($request->get('password'));

        if ($user->save()) {
            Session::flash('message', sprintf("New user %s %s added", $user->name, $user->lastname));
            Session::flash('m-status', "success");
        }
        
        return redirect('admin/users');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            $data = [
                'user' => $user,
                'levels' => Userlevel::levels(),
            ];
            return view('users.edit', $data);
        }
        $message = "User not found";
        $status = "info";
        return redirect('admin/users')
            ->with('message', $message)
            ->with('m-status', $status);
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
        $user = User::find($id);

        if ($user) {
            try {
                $this->authorize('update', $user);
                $message = sprintf("User %s %s have been updated successfully", $user->name, $user->lastname);
                $status = "success";

                //check email logic, must move
                $check_email = User::where('email', $request->get('email'))->where('id', '!=', $id)->first();

                if (!$check_email) {
                    $user->name = $request->get('name');
                    $user->lastname = $request->get('lastname');
                    $user->email = $request->get('email');

                    if (!empty($request->get('password')) && !empty($request->get('confirm_password'))) {
                        if ($request->get('password') == $request->get('confirm_password')) {
                            $user->password = bcrypt($request->get('password'));
                        }
                    }

                    $user->save();

                } else {
                    return redirect()->back()
                        ->with('message', 'This email haven been already taken')
                        ->with('m-status', 'danger');
                }
                
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
        $user = User::find($id);
        $message = null;
        $status = null;
        if ($user) {
            try {
                $this->authorize('destroy', $user);
                $message = sprintf("User %s %s have been deleted successfully", $user->name, $user->lastname);
                $status = "success";
                $user->delete();
            } catch (\Exception $e) {
                $message = trans('site.not_authorized');
                $status = "danger";
            }
            return redirect('admin/users')
                ->with('message', $message)
                ->with('m-status', $status);
        }
        return redirect('admin/users')
            ->with('message', sprintf("Can not delete User %s %s", $user->name, $user->lastname))
            ->with('m-status', 'danger');
    }

    /**
     * Process datatables ajax request.
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax_list(Request $request)
    {

        $users = User::select(['id', 'name', 'lastname', 'level_id']);


        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return view('partials.datatables.basic_actions',
                            [
                                'controller'    => 'admin.users',
                                'id'            => $user->id,
                                'edit'          => true,
                                'delete'        => true
                            ]
                )->render();
            })
            ->editColumn('name', function($user) {
                return sprintf("<a href='%s'> %s</a>", action('Admin\Users@edit', $user->id), $user->name);
            })
            ->make(true);
    }
}
