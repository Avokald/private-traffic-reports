<?php

namespace App\Http\Controllers\Admin;

use App\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $fields = [
        [
            'title' => 'Заголовок',
            'field_name' => 'title',
            'placeholder' => '',
            'template' => 'text',
        ],
        [
            'title' => 'Описание',
            'field_name' => 'description',
            'placeholder' => '',
            'template' => 'textarea',
        ],
        [
            'title' => 'Изображениея',
            'field_name' => 'images[]',
            'placeholder' => '',
            'template' => 'repeater',
            'repeater-type' => 'image',
        ],
        [
            'title' => 'Видео',
            'field_name' => 'videos[]',
            'placeholder' => '',
            'template' => 'repeater',
            'repeater-type' => 'video',
        ],
        [
            'title' => 'Карта',
            'field_name' => '',
            'placeholder' => '',
            'template' => 'map',
        ],
    ];

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
        $reports = Report::all();

        return view('admin.reports.layout_archive', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $report = new Report();
        return view('admin.reports.layout_single', compact('report'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report = Report::create($request->toArray());
        return redirect()->route('admin.reports.edit', $report->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(int $reportId)
    {
        $report = Report::findOrFail($reportId);
        return view('admin.reports.layout_single', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $reportId)
    {
        $report = Report::findOrFail($reportId);

        $report->update($request->toArray());

        $report->save();
        return redirect()->route('admin.reports.edit', $reportId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $report_id)
    {
        $report = Report::findOrFail($report_id);
        $report->delete();
        return redirect()->back();
    }
}
