<?php

namespace App\Http\Controllers;

class VeterinarianController extends Controller
{
    public function index()
    {
        return view('veterinarians.index');
    }

    public function create()
    {
        return view('veterinarians.create');
    }

    public function collaboration()
    {
        return view('veterinarians.collaboration');
    }
}
