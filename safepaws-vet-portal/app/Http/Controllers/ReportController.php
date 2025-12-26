<?php

namespace App\Http\Controllers;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function create()
    {
        return view('reports.create');
    }

    public function show($id)
    {
        return view('reports.show', compact('id'));
    }
}
