<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (isset(request()->f) && isset(request()->t)) {
            $validator = Validator::make(request()->all(), [
                'f' => 'date|date_format:Y-m-d',
                't' => 'date|date_format:Y-m-d',
            ]);
            if ($validator->fails()) {
                $reports = [];
            } else {
                $reports = \App\Report::whereBetween('created_at', [request()->f, request()->t])->get();
            }
        } else {
            $reports = \App\Report::all();
        }
        return view('welcome', compact('reports'));
    }
}
