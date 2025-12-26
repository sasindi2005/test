<?php

namespace App\Http\Controllers;

class SystemPageController extends Controller
{
    public function contact() { return view('system.contact'); }
    public function faq() { return view('system.faq'); }
    public function help() { return view('system.help'); }
    public function privacy() { return view('system.privacy'); }
    public function activity() { return view('system.activity'); }
    public function notifications() { return view('system.notifications'); }
    public function profile() { return view('system.profile'); }
    public function logout() { return redirect('/'); }
}
