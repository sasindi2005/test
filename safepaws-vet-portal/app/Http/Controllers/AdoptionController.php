<?php

namespace App\Http\Controllers;

class AdoptionController extends Controller
{
    public function index()
    {
        return view('adoptions.index');
    }

    public function create()
    {
        return view('adoptions.create');
    }

    public function show($id)
    {
        return view('adoptions.show', compact('id'));
    }
}
