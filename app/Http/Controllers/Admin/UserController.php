<?php

namespace App\Http\Controllers\Admin;

use \App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\Admin\AdminAuthenticate::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.layout_archive', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        return view('admin.users.layout_single', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_array = $request->toArray();
        $request_array['password'] = Hash::make($request->password_unsafe);
        $user = User::create($request_array);

        return redirect()->route('admin.users.edit', $user->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(int $userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.users.layout_single', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $userId)
    {
        $user = User::findOrFail($userId);

        $user->update($request->toArray());
        $user->password = Hash::make($request->password_unsafe);
        $user->save();

        return redirect()->route('admin.users.edit', $userId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();
        return redirect()->back();
    }
}
