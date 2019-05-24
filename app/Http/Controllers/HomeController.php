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
        $query = \App\Report::query();
        if (isset(request()->f, request()->t)) {
            $validator = Validator::make(request()->all(), [
                'f' => 'date|date_format:Y-m-d',
                't' => 'date|date_format:Y-m-d',
            ]);
            if ($validator->fails()) {
                $query = \App\Report::where('id', 0);
            } else {
                $query = $query->whereBetween('created_at', [request()->f, request()->t]);
            }
        }

        if (isset(request()->category_id)) {
            $validator = Validator::make(request()->all(), [
                'category_id' => 'integer',
            ]);
            if ($validator->fails()) {
                $query = \App\Report::where('id', 0);
            } else {
                $query = $query->where('category_id', request()->category_id);
            }
        }


        if (isset(request()->tags_id)) {
            $validator = Validator::make(request()->all(), [
                'tags_id' => 'array',
            ]);
            if ($validator->fails()) {
                $query = \App\Report::where('id', 0);
            } else {
                $request_tags = request()->tags_id;
                $query = $query->whereHas('tags', function($q) use ($request_tags) {
                    $q->whereIn('id', $request_tags);
                });
            }
        }




        $reports = $query->get();

        $allCategories = \App\Category::all();
        $allTags = \App\Tag::all();
        return view('welcome',
            compact(
                'reports',
                'allCategories',
                'allTags')
        );
    }
}
