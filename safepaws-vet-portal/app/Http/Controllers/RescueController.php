<?php

namespace App\Http\Controllers;

class RescueController extends Controller
{
    public function index()
    {
        return view('rescues.index');
    }

    public function create()
    {
        return view('rescues.create');
    }

    public function show($id)
    {
        return view('rescues.show', compact('id'));
    }
}
