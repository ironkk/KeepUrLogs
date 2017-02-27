<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

class Login extends Controller
{
    //
    public function index()
    {
        return view('site.index');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'                => 'required|email',
            'password'             => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ];

        /** @var Validator $validator */
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $remember_me = $request->get('remember_me') == "on" ? 1 : 0;

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $remember_me)) {
            // Authentication passed...
            return redirect()->intended('/');
        }

        return redirect('/login')->with('fail_login', trans('site.fail_login'));
    }

    public function signout()
    {
        Auth::logout();
        return redirect('/');
    }
}
