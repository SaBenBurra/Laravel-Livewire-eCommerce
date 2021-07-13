<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard() {
        return view('panel.pages.dashboard');
    }

    public function users() {
        return view('panel.pages.users');
    }
}
