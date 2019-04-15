<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    private $title_plural = 'Теги';
    private $title_singular = 'Тег';

    private $fields = [
        'title' => [
            'title' => 'Заголовок',
            'template' => 'text',
        ],
        'description' => [
            'title' => 'Описание',
            'template' => 'textarea',
        ],
        'color' => [
            'title' => 'Цвет',
            'template' => 'color',
        ]
    ];

    private $table_fields = [
        'id' => [
            'title' => 'ID',
        ],
        'color' => [
            'title' => 'Цвет',
            'template' => 'color',
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
        $tags= Tag::paginate(15);
        return view('admin.index', [
            'values' => $tags,
            'title' => $this->title_plural,
            'fields' => $this->table_fields,
            'route_name' => 'tags',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = new Tag();
        return view('admin.edit', [
            'value' => $tag,
            'title_plural' => $this->title_plural,
            'title_singular' => $this->title_singular,
            'fields' => $this->fields,
            'route_name' => 'tags',
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
        $tag = Tag::create($request->toArray());
        return redirect()->route('admin.tags.edit', $tag->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(int $tagId)
    {
        $tag = Tag::findOrFail($tagId);
        return view('admin.edit', [
            'value' => $tag,
            'title_plural' => $this->title_plural,
            'title_singular' => $this->title_singular,
            'fields' => $this->fields,
            'route_name' => 'tags',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $tag->update($request->toArray());
        $tag->save();
        return redirect()->route('admin.tags.edit', $tagId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $tag->delete();
        return redirect()->route('admin.tags.index');
    }
}
