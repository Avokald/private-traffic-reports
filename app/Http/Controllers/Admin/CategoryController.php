<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    private $title_plural = 'Категории';
    private $title_singular = 'Категория';

    private $fields = [
        'title' => [
            'title' => 'Заголовок',
            'template' => 'text',
            ],
        'description' => [
            'title' => 'Описание',
            'template' => 'textarea',
        ],
         'marker_url' => [
             'title' => 'Иконка',
             'template' => 'image',
         ]
    ];

     private $table_fields = [
         'id' => [
            'title' => 'ID',
         ],
         'marker_url' => [
             'title' => 'Иконка',
             'template' => 'image',
         ],
         'title' => [
            'title' => 'Заголовок',
         ],
         'description' => [
             'title' => 'Описание',
         ],
         'created_at' => [
            'title' => 'Дата создания',
         ],
     ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(15);
        return view('admin.index', [
            'values' => $categories,
            'title' => $this->title_plural,
            'fields' => $this->table_fields,
            'route_name' => 'categories',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view('admin.edit', [
            'value' => $category,
            'title_plural' => $this->title_plural,
            'title_singular' => $this->title_singular,
            'fields' => $this->fields,
            'route_name' => 'categories',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($request->toArray());
        return redirect()->route('admin.categories.edit', $category->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(int $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('admin.edit', [
            'value' => $category,
            'title_plural' => $this->title_plural,
            'title_singular' => $this->title_singular,
            'fields' => $this->fields,
            'route_name' => 'categories',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->update($request->toArray());
        $category->save();
        return redirect()->route('admin.categories.edit', $categoryId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
