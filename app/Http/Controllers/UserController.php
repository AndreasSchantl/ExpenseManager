<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Exception\UnsupportedOperationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', array('users' => User::orderBy('lname', 'asc')->get()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'username' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'password' => 'required|min:6',
            'password-repeat' => 'required'
        ]);

        $u = new User();
        $u->username = request('username');
        $u->fname = request('fname');
        $u->lname = request('lname');

        if(request('password') === request('password-repeat')) {
            $u->password = Hash::make(request('password'));
        } else {
            return back()->withErrors(__('app.user_info_passmismatch'));
        }

        try {
            $u->save();
            return redirect('users')->with('info', __('app.user_info_created'));
        } catch(\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $u = User::findOrFail($id);
        return view('users.edit', array('user' => $u));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'username' => 'required',
            'fname' => 'required',
            'lname' => 'required',
        ]);

        $u = User::findOrFail($id);
        $u->username = request('username');
        $u->fname = request('fname');
        $u->lname = request('lname');

        if(request('password') != null) {
            if (request('password') === request('password-repeat')) {
                $u->password = Hash::make(request('password'));
            } else {
                return back()->withErrors(__('app.user_info_passmismatch'));
            }
        }

        try {
            $u->save();
            return redirect('users')->with('info', __('app.user_info_updated', ['user' => $u->fname . ' ' . $u->lname]));
        } catch(\Exception $e) {
            return back()->withErrors($e->getMessage());
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
        $u = User::findOrFail($id);

        try {
            $u->delete();
            return back()->with('info', __('app.user_info_deleted', ['user' => $u->fname . ' ' . $u->lname]));
        } catch(\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
